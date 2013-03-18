<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<tr>
    <td style="width: 45%;text-align: right;">
        <?php
        echo $title;
        echo ($required == 1) ? '<span class="required"> *</span>' : '';
        ?>
    </td>
    <td>
        <?php
        switch ($type) {
            case 'text':
                echo form_input($attr);
                $name=$attr['name'];// validator
                break;
            case 'password':
                echo form_password($attr);
                $name=$attr['name'];
                break;
            case 'select':
                echo form_dropdown($attr['name'], $attr['option'], $attr['value'], $attr['class']);
                $name=$attr['name'];
                break;
            case 'file':
                echo form_upload($name);
                if ($upload==1) echo '<span class="error">'.$this->upload->display_errors().'</span>';
                //$name='userfile';
                break;
            case 'textarea':
                echo form_textarea($attr);
                $name=$attr['name'];
                break;

            default:
                $name='Missing or incorrect type of input';
                break;
        }
        // validator
        echo ($validator==1)?'<span class="error">' . form_error($name) . '</span>':'';
        ?>
    </td>
</tr>
