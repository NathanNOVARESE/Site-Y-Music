<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="../Assets/styles/stylesign.css" rel="stylesheet">
    <link rel="icon" href="icon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="logo.png" alt="logo" class="logo">
        </div>
        
        <div class="form">
            <div class="form_input">
                <div id="messageDiv" style="display: none;"></div>
                <form id="signupForm" method="POST" action="traitement.php" enctype="multipart/form-data">
                    <!-- Page 1 -->
                    <div id="page1">
                        <input type="file" name="profile_picture">
                        <br />
                        <div class="input_shadow">
                            <input type="text" name="firstname" placeholder="First Name" required>
                            <br />
                            <input type="text" name="lastname" placeholder="Last Name" required>
                            <br />
                            <input type="text" name="username" placeholder="Username" required>
                            <br />
                            <input type="email" name="email" placeholder="Email" required>
                            <br />
                            <input type="password" name="password" placeholder="Password" required>
                            <br />
                            <input type="password" name="confpassword" placeholder="Confirm Password" required>
                            <br />
                        </div>
                        <div class="button">
                            <button type="button" id="nextBtn">Next</button>
                        </div>
                    </div>
                    <!-- Page 2 -->
                    <div id="page2" class="form-page" style="display: none;">
                        <textarea name="description" placeholder="Description" required></textarea>
                        <br />
                        <input type="text" name="artist1" id="artist1" list="artist1-list" placeholder="Favorite Artist 1" required>
                        <datalist id="artist1-list"></datalist>
                        <br />
                        <input type="text" name="artist2" id="artist2" list="artist2-list" placeholder="Favorite Artist 2" required>
                        <datalist id="artist2-list"></datalist>
                        <br />
                        <input type="text" name="artist3" id="artist3" list="artist3-list" placeholder="Favorite Artist 3" required>
                        <datalist id="artist3-list"></datalist>
                        <br />
                        <input type="text" name="song1" id="song1" list="song1-list" placeholder="Favorite Song 1" required>
                        <datalist id="song1-list"></datalist>
                        <br />
                        <input type="text" name="song2" id="song2" list="song2-list" placeholder="Favorite Song 2" required>
                        <datalist id="song2-list"></datalist>
                        <br />
                        <input type="text" name="song3" id="song3" list="song3-list" placeholder="Favorite Song 3" required>
                        <datalist id="song3-list"></datalist>
                        <br />
                        <div class="button">
                            <button type="submit" name="submit">Sign In</button>
                        </div>
                    </div>
                </form>
                <div class="divider">
                    <div class="divider-line"></div>
                    <p class="p">ou</p>
                    <div class="divider-line"></div>
                </div>
                <div class="button_inscription">
                    <button type="button" onclick="window.location.href='login.php'">Log In</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nextBtn').addEventListener('click', function() {
            if (validatePage1()) {
                document.getElementById('page1').style.display = 'none';
                document.getElementById('page2').style.display = 'block';
            }
        });

        document.getElementById('signupForm').addEventListener('submit', function(event) {
            if (!validatePage2()) {
                event.preventDefault();
            }
        });

        function validatePage1() {
            const inputs = document.querySelectorAll('#page1 input[required]');
            for (const input of inputs) {
                if (!input.value) {
                    input.focus();
                    alert('Veuillez remplir tous les champs.');
                    return false;
                }
            }
            return true;
        }

        function validatePage2() {
            const inputs = document.querySelectorAll('#page2 input[required], #page2 textarea[required]');
            for (const input of inputs) {
                if (!input.value) {
                    input.focus();
                    alert('Veuillez remplir tous les champs.');
                    return false;
                }
            }
            return true;
        }

        const artistInputs = ['artist1', 'artist2', 'artist3'];
        const songInputs = ['song1', 'song2', 'song3'];

        function searchSpotify(query, type, inputId) {
            const settings = {
                async: true,
                crossDomain: true,
                url: `https://spotify23.p.rapidapi.com/search/?q=${encodeURIComponent(query)}&type=${type}&offset=0&limit=10&numberOfTopResults=5`,
                method: 'GET',
                headers: {
                    'X-RapidAPI-Key': '2f5ad5797dmsh041d88b4e85b622p185f87jsnfd0f7b717a11',
                    'X-RapidAPI-Host': 'spotify23.p.rapidapi.com'
                }
            };

            $.ajax(settings).done(function (response) {
                const dataListId = inputId + '-list';
                const dataList = document.getElementById(dataListId);
                dataList.innerHTML = ''; // Clear previous results

                const items = type === 'artist' ? response.artists.items : response.tracks.items;
                items.forEach(item => {
                    const option = document.createElement('option');
                    if (type === 'artist') {
                        option.value = item.data.profile.name;
                    } else {
                        option.value = `${item.data.name} - ${item.data.artists.items[0].profile.name}`;
                    }
                    dataList.appendChild(option);
                });
            });
        }

        artistInputs.forEach(inputId => {
            const inputElement = document.getElementById(inputId);
            inputElement.addEventListener('input', function() {
                const query = this.value;
                if (query.length > 2) {
                    searchSpotify(query, 'artist', inputId);
                }
            });
        });

        songInputs.forEach(inputId => {
            const inputElement = document.getElementById(inputId);
            inputElement.addEventListener('input', function() {
                const query = this.value;
                if (query.length > 2) {
                    searchSpotify(query, 'track', inputId); // Recherche de chansons
                }
            });
        });

        // Vérifiez s'il y a un message à afficher dans l'URL (peut être une redirection depuis traitement.php)
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        // Affichez le message s'il est présent
        if (message) {
            const messageDiv = document.getElementById('messageDiv');
            messageDiv.innerText = message;
            messageDiv.style.display = 'block';
        }
    </script>

</body>
</html>
