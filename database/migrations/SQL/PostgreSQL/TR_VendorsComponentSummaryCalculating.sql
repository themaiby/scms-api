-- INSERT
DROP TRIGGER IF EXISTS tr_vendors_summary_insert ON components;
CREATE TRIGGER tr_vendors_summary_insert
    AFTER INSERT ON components
    FOR EACH ROW EXECUTE PROCEDURE calculate_vendor_summary();

-- UPDATE
DROP TRIGGER IF EXISTS tr_vendors_summary_update ON components;
CREATE TRIGGER tr_vendors_summary_update
    AFTER UPDATE ON components
    FOR EACH ROW EXECUTE PROCEDURE calculate_vendor_summary();

-- DELETE
DROP TRIGGER IF EXISTS tr_vendors_summary_update ON components;
CREATE TRIGGER tr_vendors_summary_update
    AFTER DELETE ON components
    FOR EACH ROW EXECUTE PROCEDURE calculate_vendor_summary();
