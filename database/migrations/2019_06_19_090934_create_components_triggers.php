<?php

use Illuminate\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateComponentsTriggers extends Migration
{
    /**
     * @var Repository
     */
    private $connectionName;

    public function __construct()
    {
        $this->connectionName = config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if ($this->connectionName === 'mysql') {
            $this->createMySQLTriggers();
        } elseif ($this->connectionName === 'pgsql') {
            $this->createPgSQLTriggers();
        }
    }

    private function createMySQLTriggers(): void
    {
        /** onInsert */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_insert 
            BEFORE INSERT ON components
            FOR EACH ROW SET new.cost = new.quantity * new.price
        ');

        /** onUpdate */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_update 
            BEFORE UPDATE ON components
            FOR EACH ROW SET new.cost = new.quantity * new.price
        ');
    }

    private function createPgSQLTriggers(): void
    {
        /** Trigger function */
        DB::unprepared('
            CREATE OR REPLACE FUNCTION calculate_components_cost()
              RETURNS trigger AS
            $BODY$
                BEGIN
                   NEW.cost := NEW.quantity * NEW.price;
               RETURN NEW;
            END;
            $BODY$
            LANGUAGE plpgsql;
        ');

        /** onInsert */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_insert 
            BEFORE INSERT ON components
            FOR EACH ROW EXECUTE PROCEDURE calculate_components_cost();
        ');

        /** onUpdate */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_update
            BEFORE UPDATE ON components
            FOR EACH ROW EXECUTE PROCEDURE calculate_components_cost();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if ($this->connectionName === 'mysql') {
            $this->deleteMySQLTriggers();
        } elseif ($this->connectionName === 'pgsql') {
            $this->deletePgSQLTriggers();
        }
    }

    private function deleteMySQLTriggers(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_update;');
    }

    private function deletePgSQLTriggers(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_insert ON components;');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_update ON components;');
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_components_cost();');
    }
}
