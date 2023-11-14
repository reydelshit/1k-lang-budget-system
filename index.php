<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">

    <title>Assignment</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="whole_page_container">
        <header>
            <div>
                <img src="./assets/images/logo.png" alt="logo">
            </div>
            <div class="overlay"></div>
            <div class="navigation_link__container">
                <a href="#">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>

            <button><a href="/oconproject/login.php" <?php if ($current_page === 'login.php') echo 'class="active"'; ?>>Login</a></button>
        </header>

        <main>
            <div class="main_l_container">
                <h2>South East Asian Institute of Technology, Inc.</h2>
                <p>South East Asian Institute of Technology, Inc. has been recognized as a Higher Education institution in Tupi, South Cotabato that has consistently adhered to its advocacy and program of affordable higher education for the Indigenous people and neighboring tribes during the Gawad Parangal for HEIs in Region 12 last July 23, 2021 at South Cotabato Gymnasium, Koronadal City.</p>
                <button><a href="#about">About</a></button>
            </div>
            <div class="main_r_container">
                <img src="./assets/images/seait.jpg" alt="illustration-intro">
            </div>
        </main>


        <div class="about" id="about">
            <h1>About</h1>
            <p>
                The South East Asian Institute of Technology, Inc. offer free education to all programs in college. The school is supported with different government sectors and NGOs
                <br />
                <br />

                South East Asian Institute of Technology, Inc. with its famous acronym SEAIT was formed like a drama with a glaring spotlights in an amphitheater. The backdrops were up, the playwrights were ready, the actors and actresses well-dressed, the orchestra were playing the timeless music and the curtain started to open………slowly.

                February 2006 marked the foundation of the dream school, not with the breaking ground but with the first cracking of the door in literal sense, the school occupied a rented space at Shell Gasoline station near Valera’s place still in Tupi which catered minimal population of students who too up vocational courses. The Tamayos reminisced their struggles upon putting the desired institution. One of these struggles was the conduciveness of learning employed in the pilot institution. What learning is to be expected in a small rectangular space? This question begged the public interest yet the family never surrender neither tried to give up their guiding philosophy- to give quality over quantity education. It was Mr. Reynaldo S Tamayo and is wife Mrs. Rochelle P. Tamayo who served as the pioneering administrators of the school. Both were driven by passion and love for education and humanity and magnanimity were their second skin.

                At first, SEAIT offered technical and vocational courses like Computer Programming NC IV and Computer Hardware Servicing NC II. The breakthrough of History started on the second phase of the institution. SEAIT was granted by the Technical Education Skills Development Authority (TESDA) to offer Hotel and Restaurant Management. The next year, the Commission on Higher Education (CHED) permitted the school to offer the first four-years science course-Bachelor of Science in Information Technology (BSIT) which successfully persuaded the target market.
            </p>

        </div>

        <div class="contact" id="contact">
            <h1>
                Contact.
            </h1>

            <div>
                <p>9505 Tupi, South Cotabato, Philippines</p>
                <p>(083) 226 1602 REGISTRAR</p>
                <p>seaitinc@yahoo.com Registrar</p>
                <p> seaitmis@seait-edu.ph MIS</p>
                <p>Monday - Friday, 08:00AM - 05:00 PM</p>
                <button>Contact Now</button>


            </div>

        </div>

        <footer>

            <span>Copyright 2023. All Rights Reserved</span>

        </footer>

    </div>


</body>

</html>