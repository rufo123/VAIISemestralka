<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Rudolf Šimo | Projects</title>
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
</head>
<body>
<?php include 'incPageContent/header.php'; ?> <!-- Header -->

<div class="contentContainer">
    <div class="contentBox">

        <h1>Projekty:</h1>
        <div class="project-box">
        <article class="projects-article">
            <h2 class="project-title"> Snake: [Java] </h2>

            <p>
            Moja prvá semestrálna práca, naprogramovaná v Jave. Hra je fakticky jednoduchý klon "Snake-a", kde
            sa vykreslia hracie polia z matice (kde obsah matíc je vždy načítaný z textového súboru)...
            Pointov hry je "jesť", ako had jablká [Červené políčka] a zaplniť hadom celú hraciu plochu [Biele políčka].
            Samozrejme had sa zväčšuje po "zjedení jablka"
            </p>
        </article>
        <div class="cover-projects-img">
            <img src="images/projects/snake_java.png" alt="Snake Java" title="Snake v Jave">
        </div>
        </div>





        <div class="project-box">
        <article class="projects-article">
            <h2 class="project-title"> Pac-Man: [Java] </h2>

            <p>
                Moja druhá semestrálna práca, naprogramovaná v programovacom jazyku Java, s použitím princípov dedičnosti.
                Pacman, je žltý, duchovia sú farebný. Jeho úlohou je zozbierať všetky fialové bodky a tak vyhrať hru, bez
                toho aby prišiel o všetky životy.
            </p>
        </article>
        <div class="cover-projects-img">
        <img class="project-img" src="images/projects/pacman_java.png" alt="Pacman v Jave">
        </div>


        </div>
        <div class="project-box">
        <article class="projects-article">
            <h2 class="project-title"> Tanky: [C++] </h2>



            <p>
                Hra pre 2 hráčov napogramovaná v jazyku C++, riešená spolu so synchronizačným problémom.
                Využité Thready a Sockety pre sieťovú komunikáciu. Princíp hry spočíta v "zabití" druhého
                hráča. Vyhráva hráč, ktorý prežije. - Vytvorené v spolupráci s: Michal Urbánek.

            </p>
        </article>
        <div class="cover-projects-img">
        <img class="project-img" src="images/projects/tanky_cpp.png" alt="Tanky">
        </div>
        </div>




        <div class="project-box">
        <article class="projects-article">
            <h2 class="project-title"> Pumpa: [AnyLogic] </h2>
            <p>
                Simulačný model vytvorený pre potreby predmetu Modelovanie a Simulácia. Cieľom modelu bolo zistiť
                odpoveďe na otázky, zadané na začiatku, experimentovanie s modelom. A zistenie prípadných zlepšení.
                Vytvorené v spolupráci s: Richard Gabarík, Michal Urbánek.

            </p>
        </article>
        <div class="cover-projects-img">
        <img class="project-img" src="images/projects/pumpa_anylogic.png" alt="sda">
        </div>
        </div>
    </div>
</div>

<?php include "incPageContent/footer.php"?>

</body>
</html>