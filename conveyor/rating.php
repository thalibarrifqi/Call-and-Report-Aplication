<?php
    include '../koneksi.php';
    session_start();
    $username=$_SESSION['username'];
    $queryconv=mysqli_query($koneksi, "SELECT nama FROM conveyor WHERE username='$username'");
    $queryconv1=mysqli_fetch_assoc($queryconv);
    $conveyor=$queryconv1['nama'];
    $query1 = mysqli_query($koneksi, "SELECT * FROM problem WHERE conveyor='$conveyor' && MONTH(date)=MONTH(CURRENT_DATE())");
    foreach ($query1 as $row) {
        if ($row['rating_teknisi'] != NULL) {
            echo "
    <div class='card'>
        <div class='card-header'>
        <center>
        <h4>".$row['nama_gl']."</h4>
        </center>
        </div>
        <div class='card-body'>
        <blockquote class='blockquote mb-0'>
            <p>
            <center>
                <br>  ";
                if ($row['rating_teknisi'] == 0.5) {
                    echo"<img src='bintang 05.png'";
                }

                elseif ($row['rating_teknisi'] == 1) {
                    echo "<img src='bintang 1.png'";
                }

                elseif ($row['rating_teknisi'] == 1.5) {
                    echo "<img src='bintang 15.png'";
                }

                elseif ($row['rating_teknisi'] == 2) {
                    echo "<img src='bintang 2.png'";
                }
                    elseif ($row['rating_teknisi'] == 2.5) {
                    echo "<img src='bintang 25.png'";
                } 
                elseif ($row['rating_teknisi'] == 3) {
                    echo "<img src='bintang 3.png'";
                }
                    elseif ($row['rating_teknisi'] == 3.5) {
                    echo "<img src='bintang 35.png'";
                }
                    elseif ($row['rating_teknisi'] == 4) {
                    echo "<img src='bintang 4.png'";
                }
                    elseif ($row['rating_teknisi'] == 4.5) {
                    echo "<img src='bintang 45.png'";
                }
                else{
                    echo "<img src='bintang 5.png'";
                }
                echo "
            </center>
            </p>

            <br>

            <p>
            <center>
                Komentar & Saran <br>
                ".$row['feedback_teknisi']."
            </center>
            </p>
        </div>
    </div>
        <br>
            ";
        }
    }
?>