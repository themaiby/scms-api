-- On components INSERT
CREATE TRIGGER `tr_components_cost_insert`
    BEFORE INSERT
    ON `components`
    FOR EACH ROW SET new.cost = new.quantity * new.price;

-- on components UPDATE
CREATE TRIGGER `tr_components_cost_update`
    BEFORE UPDATE
    ON `components`
    FOR EACH ROW SET new.cost = new.quantity * new.price;
