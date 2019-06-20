<?php

use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Class CreateComponentsTriggers
 */
class CreateComponentsTriggers extends Migration
{
    /**
     * @var Repository
     */
    private $connectionName;

    private $pathToPgSQLFiles = './database/migrations/SQL/PostgreSQL/';
    private $pathToMySQLFiles = './database/migrations/SQL/MySQL/';

    public function __construct()
    {
        $this->connectionName = config('database.default');
    }

    /**
     * @param string $fileName
     * @return string
     * @throws FileNotFoundException
     */
    private function getMySQLFile(string $fileName): string
    {
        return File::get($this->pathToMySQLFiles . $fileName . '.sql');
    }

    /**
     * @param string $fileName
     * @return string
     * @throws FileNotFoundException
     */
    private function getPgSQLFile(string $fileName): string
    {
        return File::get($this->pathToPgSQLFiles . $fileName . '.sql');
    }

    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {
        if ($this->connectionName === 'mysql') {
            $this->createMySQLTriggers();
        } elseif ($this->connectionName === 'pgsql') {
            $this->createPgSQLTriggers();
        } else {
            throw new RuntimeException('Is supported only MySQL and PostgreSQL databases');
        }
    }

    private function createMySQLTriggers(): void
    {
        /** onInsert - each COMPONENT cost */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_insert 
            BEFORE INSERT ON components
            FOR EACH ROW SET new.cost = new.quantity * new.price
        ');

        /** onUpdate - each COMPONENT cost */
        DB::unprepared('
            CREATE TRIGGER tr_components_cost_update 
            BEFORE UPDATE ON components
            FOR EACH ROW SET new.cost = new.quantity * new.price
        ');
    }

    private function createPgSQLTriggers(): void
    {
        // Defining functions
        DB::unprepared($this->getPgSQLFile('FN_CalculateComponentsCost'));
        DB::unprepared($this->getPgSQLFile('FN_CalculateVendorSummary'));

        // Setting triggers
        DB::unprepared($this->getPgSQLFile('TR_ComponentsCostCalculating'));
        DB::unprepared($this->getPgSQLFile('TR_VendorsComponentSummaryCalculating'));
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
        } else {
            throw new RuntimeException('Is supported only MySQL and PostgreSQL databases');
        }
    }

    /**
     * @return void
     */
    private function deleteMySQLTriggers(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_update;');
    }

    /**
     * @return void
     * todo: move to SQL
     */
    private function deletePgSQLTriggers(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_insert ON components;');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_components_cost_update ON components;');
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_components_cost();');
    }
}
