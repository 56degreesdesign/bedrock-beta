<?php
function get_auto_sections($name, $url)
{
    if (have_rows($name)) {
        while (have_rows($name)) {
            the_row();

            $templateName = get_row_layout();
            $fileName = str_replace('_', '-', $templateName);
            $path = get_template_directory() . '/' . $url . '/' . $fileName . '.php';
            $data = null;

            if (file_exists($path)) {
                $data = get_sub_field($templateName);
                
                // get section local or global
                if ( isset($data['scope_type']) ) {
                    $data = $data['scope_type'] ? get_field($templateName, 'option')[$templateName] : $data['section'][$templateName];
                }
                
                echo "<!-- " . $fileName . " -->";
                get_template_part($url . '/' . $fileName, null, ['data' => $data]);
            } else {
                echo "<p style='color: red;'>no find file: " . $fileName . " in template: " . $templateName . "</p>";
            }
        }
    }
}
