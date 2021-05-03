<?php include '../view/header.php'; ?>
<main>
    <h1>Update Incident</h1>
    <form action="index.php" method="post" id="update_incident_form">
        <input type="hidden" name="action" value="update_incident_form">
        
        <label>Incident:</label>
        <select name="incident_id">
            <?php foreach ($incidents as $incident) : ?>
                <option value="<?php echo $incident['incidentID']; ?>">
                    <?php echo $incident['title']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Date Closed:</label>
        <input type="text" name="date_closed" />
        <label class="special">Use MM/DD/YYYY date format</label>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Incident" />
        <br>
    </form>
    
</main>
<?php include '../view/footer.php'; ?>