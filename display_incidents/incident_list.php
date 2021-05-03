<?php include '../view/header.php'; ?>
<main>
    <h1>Incident List</h1>

    <section>
        <!-- display a table of products -->
        <table>
            <tr>
                <th>Incident ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Technician</th>
                <th>Closed Date</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['incidentID']; ?></td>
                <td><?php echo $incident['title']; ?></td>
                <td><?php echo $incident['description']; ?></td>
                <td><?php echo $incident['firstName'] . ' ' . $incident['lastName']; ?></td>
                <td><?php echo $incident['name']; ?></td>
                <td><?php echo $incident['24'] . ' ' . $incident['25']; ?></td>
                <td><?php if($incident['dateClosed'] != null) echo date("d-m-Y", strtotime($incident['dateClosed'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </table> 
    </section>
</main>
<?php include '../view/footer.php'; ?>