/*
 Calculate vendors fields `components_cost` and `components_count`
 based on insert, update or delete components table
 */
CREATE OR REPLACE FUNCTION calculate_vendor_summary() RETURNS TRIGGER AS $BODY$
BEGIN
    --- Triggers on INSERTING components
    UPDATE vendors
    SET components_cost  = component_summary.cost,
        components_count = component_summary.count
    from (SELECT count(id)                          as count,
                 coalesce(SUM(quantity * price), 0) as cost
          from components
          WHERE vendor_id = NEW.vendor_id) as component_summary
    where id = NEW.vendor_id;

    --- Triggers on UPDATING components
    IF ((OLD.vendor_id IS NOT NULL) AND (OLD.vendor_id <> NEW.vendor_id)) THEN
        UPDATE vendors
        SET components_cost  = component_summary.cost,
            components_count = component_summary.count
        from (
                 SELECT count(id)                          as count,
                        coalesce(SUM(quantity * price), 0) as cost
                 from components
                 WHERE vendor_id = OLD.vendor_id
             ) as component_summary
        where id = OLD.vendor_id;
    END IF;

    -- Triggers on DELETING components
    IF TG_OP = 'DELETE' THEN
        UPDATE vendors
        SET components_cost  = 0,
            components_count = 0
        WHERE id = OLD.vendor_id;
    END IF;
    RETURN null;
END;
$BODY$ LANGUAGE PLPGSQL;
