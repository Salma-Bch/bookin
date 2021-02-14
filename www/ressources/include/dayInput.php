<select class="form-select form-select-lg mb-3 change" name="birthMonth" aria-label="Default select example">
    <option selected="" disabled="" value="" hidden="">Jour</option>
    <?php
        for ($i = 1; $i <= 31; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    ?>
</select>
