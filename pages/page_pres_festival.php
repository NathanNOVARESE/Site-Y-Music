
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/styles/page_pres_festival.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="../includes/page_accueil.js" defer></script>

    <title>Page d'Accueil</title>
</head>

<body>
    <header>
        <nav class="nav">

            <div class="logo">
                <button class="btn_accueil1">
                    <a href="page_accueil.php">
                        <img class="logopng" src="../Assets/logo.png" alt="Logo Site Y'music">
                    </a>
                </button>
            </div>
            <div class="Accueil">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
                        <p class="Accueil2">ACCUEIL</p>
                    </a>
                </button>
            </div>
            <div class="a_propos">
                <button class="btn_accueil">
                    <a href="page_accueil.php" style="text-decoration: none;">
                        <p class="a_propos2">A PROPOS</p>
                    </a>
                </button>
            </div>
            <div class="festival">
                <button class="btn_accueil">
                    <a href="Festival.php" style="text-decoration: none;">
                        <p class="ticket2">FESTIVAL</p>
                    </a>
                </button>
            </div>
            <div class="contact">
                <button class="btn_accueil">
                    <a href="contact.php" style="text-decoration: none;">
                        <p class="contact2">CONTACT</p>
                    </a>
                </button>
            </div>

            <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Rechercher ici...">
                <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <ul class="nav-list">
                <li class="item"><a href="setting_user.php">Setting</a></li>
                <li class="item"><a href="Festival.php">Festival</a></li>
            </ul>
            <button class="btn" id="btn">
                <svg fill="#8975D1" class="hamburger" viewBox="0 0 100 100" width="45">
                    <rect class="row top" width="80" height="10" x="10" y="30" rx="5"></rect>
                    <rect class="row mid" width="80" height="10" x="10" y="50" rx="5"></rect>
                    <rect class="row bot" width="80" height="10" x="10" y="70" rx="5"></rect>
                </svg>
            </button>
        </nav>
        <div class=greybar></div>

        <img class="barre" src="../Assets/barre.png" alt="barre">        
    </header>

    <main>
      <div class="style">
        <h1>Style de musique</h1>
      </div>

      <div class="artiste">
        <h1>Artiste présent</h1>
      </div>

      <div class="tchat">
        <h1>Tchat</h1>
      </div>

      <div class="nom_festi">
        <h1 class="nom_festi_text">Nom Festival</h1>
      </div>

      <div class="carte_festi" id="map">
      </div>

      <div class="lien_billet">
        <a class="lien_billet_text" href="https://openclassrooms.com/fr/">→ Lien vers la billeterie</a>
      </div>




    </main>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyDHdkjvSTPOEOZ7aR4tFBwrZQ3PZ9fbM70",
            v: "weekly",
            // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
        });
    </script>

    <script src="../includes/page_pres_festival.js"></script>
</body>
</html>
