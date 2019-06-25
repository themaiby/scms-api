<?php


namespace App\Traits;


trait FieldSelectable
{
    /**
     * get fields which was requested by client in `fields` field
     * Only for GET requests
     * In case when its no fields requested - return all available
     * @param array $availableFields
     * @return array
     */
    public function getRequestedFields($availableFields): array
    {
        $requestedFields = request()->get('fields');

        if (!$requestedFields) {
            return $availableFields;
        }

        $fields = collect(explode(',', $requestedFields));

        return $fields->intersect($availableFields)->toArray();
    }
}
