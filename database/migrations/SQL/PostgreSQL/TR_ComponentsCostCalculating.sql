-- INSERT
DROP TRIGGER IF EXISTS tr_components_cost_insert ON components;
CREATE TRIGGER tr_components_cost_insert
    BEFORE INSERT ON components
    FOR EACH ROW EXECUTE PROCEDURE calculate_components_cost();

-- UPDATE
DROP TRIGGER IF EXISTS tr_components_cost_update ON components;
CREATE TRIGGER tr_components_cost_update
    BEFORE UPDATE ON components
    FOR EACH ROW EXECUTE PROCEDURE calculate_components_cost();
