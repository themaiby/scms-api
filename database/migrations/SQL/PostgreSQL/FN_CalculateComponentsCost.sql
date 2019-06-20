/**
  Calculate components cost based on quantity and price
 */
CREATE OR REPLACE FUNCTION calculate_components_cost() RETURNS TRIGGER AS $BODY$
BEGIN
    NEW.cost := NEW.quantity * NEW.price;
    RETURN NEW;
END;
$BODY$ LANGUAGE PLPGSQL;
