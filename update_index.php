<?php

$dirs = [
    'unmarried', 'married', 'remarried', 'landless', 'name', 'yearly_income', 'disability',
    'voter_area', 'voter_list', 'nid_correction', 'childless', 'orphan', 'financial_instability',
    'age', 'permanent_citizen', 'residential', 'guardian', 'guardian_acceptance', 'inheritance'
];

$basePath = __DIR__ . '/resources/views/backend/pages/certificate/';

foreach ($dirs as $dir) {
    $filePath = $basePath . $dir . '/index.blade.php';
    if (!file_exists($filePath)) {
        echo "File not found: $filePath\n";
        continue;
    }

    $content = file_get_contents($filePath);

    // Replace headers
    $content = preg_replace('/<th>Certificate No<\/th>/i', '<th>Certificate No & Date</th>', $content);
    $content = preg_replace('/<th>Reason<\/th>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<th>Reason<\/th>\s*-->\s*/i', '', $content);
    $content = preg_replace('/<th>Quantity<\/th>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<th>Quantity<\/th>\s*-->\s*/i', '', $content);
    $content = preg_replace('/<th>Created At<\/th>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<th>Created At<\/th>\s*-->\s*/i', '', $content);
    $content = preg_replace('/<th>Status<\/th>\s*/i', '', $content); // Hide status just in case? User only asked for Reason and Quantity and Created At. Wait, user didn't ask for Status in this prompt, but earlier they did for Citizen. I'll stick to what they asked.

    // In rows, replace Certificate No td
    // The td could be: <td>{{($certificate->system_id) }}</td> or <td>{{ Value($certificate->system_id) }}</td>
    // Let's find the td that contains system_id or certificate_number.
    // It's usually the 3rd td. We can match something like:
    // <td>{{($certificate->system_id) }}</td> or <td>{{ Value($certificate->system_id) }}</td>
    // We replace it with the new format.
    $replacementTd = "<td>\n" .
                     "                                        <strong>{{ \$certificate->system_id }}</strong><br>\n" .
                     "                                        <small class=\"text-muted\">{{ \\Carbon\\Carbon::parse(\$certificate->created_at)->format('d-m-Y') }}</small>\n" .
                     "                                    </td>";

    $content = preg_replace('/<td>\s*\{\{\s*\(?\$certificate->system_id\)?\s*\}\}\s*<\/td>/i', $replacementTd, $content);
    $content = preg_replace('/<td>\s*\{\{\s*Value\(\$certificate->system_id\)\s*\}\}\s*<\/td>/i', $replacementTd, $content);
    $content = preg_replace('/<td>\s*\{\{\s*\$certificate->certificate_number\s*\?\?\s*\(\$certificate->system_id\s*\?\?\s*\'\'\)\s*\}\}\s*<\/td>/i', $replacementTd, $content);

    // Remove td for Reason, Quantity, Created At
    // <td>{{ $certificate->reason }}</td>
    $content = preg_replace('/<td>\s*\{\{\s*\$certificate->reason\s*(?:\?\?\s*\'\')?\s*\}\}\s*<\/td>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<td>\s*\{\{\s*\$certificate->reason\s*(?:\?\?\s*\'\')?\s*\}\}\s*<\/td>\s*-->\s*/i', '', $content);

    // Quantity
    $content = preg_replace('/<td>\s*\{\{\s*\$certificate->quantity\s*(?:\?\?\s*\'\')?\s*\}\}\s*<\/td>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<td>\s*\{\{\s*\$certificate->quantity\s*(?:\?\?\s*\'\')?\s*\}\}\s*<\/td>\s*-->\s*/i', '', $content);

    // Created At td: <td>{{ $certificate->created_at->format('d-m-Y') }}</td> or <td>{{ Value(date(...)) }}</td>
    $content = preg_replace('/<td>\s*\{\{\s*\$certificate->created_at->format\([^)]+\)\s*\}\}\s*<\/td>\s*/i', '', $content);
    $content = preg_replace('/<td>\s*\{\{\s*Value\(date\([^\}]+\)\)\s*\}\}\s*<\/td>\s*/i', '', $content);
    $content = preg_replace('/<!--\s*<td>\s*\{\{\s*\$certificate->created_at->format\([^)]+\)\s*\}\}\s*<\/td>\s*-->\s*/i', '', $content);

    // Also update colspan in empty state if present
    // <td colspan="9" ...
    // Calculate new colspan: 
    // It was usually 8 or 9. We removed 1 or 2. We can just set it to 7 or 6. We can just replace colspan="\d+" with colspan="7" or similar, but actually leaving it as is might just look a bit off, better to replace colspan="\d+" with colspan="100%" or a fixed number.
    $content = preg_replace('/colspan="\d+"/', 'colspan="100%"', $content);

    file_put_contents($filePath, $content);
    echo "Updated $dir\n";
}
