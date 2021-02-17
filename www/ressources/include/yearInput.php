<select class="form-select form-select-lg mb-3 change" name="birthYear" aria-label="Default select example">
    <option selected="" disabled="" value="" hidden="">Jour</option>

    <?php
        $date = date('Y');
        for($date-1; $date >= 1900; $date--){
            echo '<option value="'.$date.'">'.$date.'</option>';
        }
    ?>
</select>
