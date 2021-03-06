<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rudolf Šimo | O Mne</title>
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
</head>
<body>
<?php include 'incPageContent/header.php'; ?> <!-- Header -->

<div class="contentContainer">
    <div class="contentBox">

        <article>
            <h1>O Mne:</h1>

            <img class="portfolio-me-img" alt="portfolio-image" src="images/about-me/portfolio-img.jpg">


            <h2>V skratke:</h2>
            <p>Som študentom Fakulty Riadenia a Informatiky v Žilinskej Univerzite v Žiline,
                kde už momentálne študujem tretí rok. K mojim záľubám patrí: Programovanie, hranie PC hier,
                práca s drevom, hranie sa s mojim psom a hľadanie riešení k nejakému problému.
            </p>


            <h2>Obľúbené hry:</h2>
            <div class="zoznam-hier">
                <table class="oblubene-hry-table">
                    <tr>
                        <td><img src="images/about-me/hry/ark.jpg" alt="ARK: Survival Evolved"
                                 title="ARK: Survival Evolved"></td>
                        <td><img src="images/about-me/hry/vermintide.jpg" alt="Warhammer: Vermintide 2"
                                 title="Warhammer: Vermintide 2"></td>
                        <td><img src="images/about-me/hry/red.jpg" alt="Red Dead Redemption 2"
                                 title="Red Dead Redemption 2"></td>
                        <td><img src="images/about-me/hry/grand.jpg" alt="Grand Theft Auto V"
                                 title="Grand Theft Auto V"></td>
                        <td><img src="images/about-me/hry/ac.jpg" alt="Assassin's Creed Séria"
                                 title="Assassin's Creed Séria"></td>
                    </tr>
                </table>
            </div>


            <h2>Development:</h2>
            <p>Medzi technológie, ktoré ovládam patrí:</p>
            <p>Technológie: Pascal (Už len veľmi okrajovo)</p>

            <div class="development-zoznam">
                <table class="development-tables">
                    <tr>
                        <td><img src="images/about-me/development/java-logo.png" alt="Java" title="Java"></td>
                        <td><img src="images/about-me/development/c-logo.png" alt="C" title="C"></td>
                        <td><img src="images/about-me/development/c++-logo.png" alt="C++" title="C++"></td>
                        <td><img src="images/about-me/development/html5-logo.png" alt="HTML5" title="HTML5"></td>
                        <td><img src="images/about-me/development/css3-logo.png" alt="CSS3" title="CSS3"></td>

                    </tr>
                </table>
            </div>


            <p>Operačné Systémy: (Linux, najmä Ubuntu, práca s BASH scriptami...)</p>
            <div class="os-zoznam">
                <table class="os-tables">
                    <tr>
                        <td><img src="images/about-me/os/windows.png" alt="Windows" title="Windows"></td>
                        <td><img src="images/about-me/os/linux.png" alt="Linux" title="Linux"></td>

                    </tr>
                </table>
            </div>

            <hr>

            <p class="contactParagraph"> V prípade akýchkoľvek otázok ma môžte kontaktovať na</p>

            <div class="contactOverlay">
                <img class="contactGmailLogo" alt="gmail-logo" src="images/about-me/gmail-logo.png">
                <p class="hiddenContactText">imorudolf@gmail.com</p>
            </div>


        </article>

    </div>

</div>

<?php include "incPageContent/footer.php" ?>

</body>

</html>