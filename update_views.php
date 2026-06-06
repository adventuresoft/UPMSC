<?php
$files = [
    'resources/views/backend/pages/basic/post_office/index.blade.php',
    'resources/views/backend/pages/basic/post_office/create.blade.php',
    'resources/views/backend/pages/basic/post_office/edit.blade.php',
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace route names and basic variables
    $content = str_replace([
        'basic-settings.union.', 
        '$unions', 
        '$union->',
        "subMenu' =>'Union'",
        "subMenu' => 'Union'",
        'Union List',
        'Union Name',
        'Union Saved',
        'Union Updated',
        'deleteUnion',
        "return redirect()->route('basic-settings.union.index')",
        "location.href = \"{{route('basic-settings.union.index')}}\"",
        "id=\"union\"",
        "for=\"union\"",
        "unionForm",
        "'Union'"
    ], [
        'basic-settings.post-office.', 
        '$post_offices', 
        '$post_office->',
        "subMenu' =>'PostOffice'",
        "subMenu' => 'PostOffice'",
        'Post Office List',
        'Post Office Name',
        'Post Office Saved',
        'Post Office Updated',
        'deletePostOffice',
        "return redirect()->route('basic-settings.post-office.index')",
        "location.href = \"{{route('basic-settings.post-office.index')}}\"",
        "id=\"post_office\"",
        "for=\"post_office\"",
        "postOfficeForm",
        "'Post Office'"
    ], $content);

    // Capitalized UI texts
    $content = str_replace(['>Union<', ' Union<', '> Union', ' Union '], ['>Post Office<', ' Post Office<', '> Post Office', ' Post Office '], $content);

    // Add postal_code input to forms and tables
    if (strpos($file, 'index.blade.php') !== false) {
        $content = str_replace('<th>Bengali Name</th>', "<th>Bengali Name</th>\n                                    <th>Postal Code</th>", $content);
        $content = str_replace('<td>{{$post_office->bn_name}}</td>', "<td>{{\$post_office->bn_name}}</td>\n                                      <td>{{\$post_office->postal_code}}</td>", $content);
    }
    
    if (strpos($file, 'create.blade.php') !== false || strpos($file, 'edit.blade.php') !== false) {
        $postalInput = <<<HTML
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Postal Code" value="{{ isset(\$post_office) ? \$post_office->postal_code : '' }}" required>
                                      <span class="text-danger error-text postal_code-error"></span>
                                    </div>
                                  </div>
HTML;
        $content = str_replace('<div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="url">', $postalInput . "\n                                  " . '<div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="url">', $content);
    }

    file_put_contents($file, $content);
    echo "Updated $file\n";
}
