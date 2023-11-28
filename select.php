<select name='' id=''>
    <?php
        while($user_dt = mysqli_fetch_assoc($resultCT)){
        echo "<option value='valor'>valor</option>";
        }
    ?>
</select>