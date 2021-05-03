<?php include '../view/header.php'; ?>
<main>
    <h1>Assign Incident</h1>
    <form action="index.php" method="post" id="assign_incident_form">
        <input type="hidden" name="action" value="assign_incident_form">
        
        <label>Incident:</label>
        <select name="incident_id">
            <?php foreach ($incidents as $incident) : ?>
                <option value="<?php echo $incident['incidentID']; ?>">
                    <?php echo $incident['title']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Technician:</label>
        <select name="tech_id">
            <?php foreach ($technicians as $technician) : ?>
                <option value="<?php echo $technician['techID']; ?>">
                    <?php echo $technician['firstName'] . ' ' . $technician['lastName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Assign Incident" />
        <br>
    </form>
    
</main>
<?php include '../view/footer.php'; ?>