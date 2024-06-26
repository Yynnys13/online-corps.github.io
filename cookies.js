document.addEventListener("DOMContentLoaded", function() {

    // Charger le fichier CSS
    function loadCSS(filename) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = filename;
        document.head.appendChild(link);
    }

    // Charger le fichier CSS pour les styles de cookie-banner et manage-cookies-banner
    loadCSS('/cookies.css');

    // Vérifier si l'utilisateur a déjà accepté les cookies
    function checkCookieConsent() {
        const consent = localStorage.getItem('cookie_consent');
        if (consent === 'accepted') {
            hideCookieBanner();
            createCookieIcon(); // Afficher l'icône de cookie si accepté
        } else {
            createCookieBanner(); // Afficher la bannière de cookie sinon
        }
    }

    // Fonction pour créer la bannière de cookie principale
    function createCookieBanner() {
        const cookieBanner = document.createElement('div');
        cookieBanner.id = 'cookie-banner';
        cookieBanner.className = 'cookie-banner'; // Ajout de classe CSS pour le style
        cookieBanner.innerHTML = `
            <p>Nous utilisons des cookies pour améliorer votre expérience.</p>
            <button id="accept-cookies" class="pointer">Accepter</button>
            <button id="reject-cookies" class="supre pointer">Refuser</button>
        `;
        document.body.appendChild(cookieBanner);

        // Écouter le clic sur le bouton Accepter
        document.getElementById('accept-cookies').addEventListener('click', acceptCookies);

        // Écouter le clic sur le bouton Refuser
        document.getElementById('reject-cookies').addEventListener('click', rejectCookies);
    }

    // Fonction pour masquer la bannière de cookie principale
    function hideCookieBanner() {
        const cookieBanner = document.getElementById('cookie-banner');
        if (cookieBanner) {
            cookieBanner.style.display = 'none';
        }
    }

    // Fonction pour créer l'icône de cookie dans un cercle
    function createCookieIcon() {
        const cookieIcon = document.createElement('div');
        cookieIcon.id = 'cookie-icon';
        cookieIcon.className = 'cookie-icon'; // Ajout de classe CSS pour le style
        cookieIcon.innerHTML = '<i class="fas fa-cookie-bite pointer"></i>'; // Icône de cookie (FontAwesome utilisé ici)
        document.body.appendChild(cookieIcon);

        // Ajouter un événement pour afficher ou masquer la bannière de gestion des cookies
        cookieIcon.addEventListener('click', toggleManageCookiesBanner);
    }

    // Fonction pour afficher ou masquer la bannière de gestion des cookies
    function toggleManageCookiesBanner() {
        const manageCookiesBanner = document.getElementById('manage-cookies-banner');
        if (!manageCookiesBanner) {
            createManageCookiesBanner(); // Créer la bannière si elle n'existe pas
        } else {
            manageCookiesBanner.style.display = (manageCookiesBanner.style.display === 'none') ? 'block' : 'none';
        }
    }

    // Fonction pour créer la bannière de gestion des cookies
    function createManageCookiesBanner() {
        const manageCookiesBanner = document.createElement('div');
        manageCookiesBanner.id = 'manage-cookies-banner';
        manageCookiesBanner.className = 'manage-cookies-banner'; // Ajout de classe CSS pour le style
        manageCookiesBanner.innerHTML = `
            <div class="banner-header">
                <span class="close-banner" id="close-banner">&times;</span>
                <p>Lire plus sur la politique de confidentialité des cookies :</p>
                <button id="read-more" class="pointer">Lire Plus</button>
                <button id="delete-cookies" class="supre pointer">Supprimer les Cookies</button>
            </div>
        `;
        document.body.appendChild(manageCookiesBanner);

        // Écouter le clic sur le bouton Lire Plus
        document.getElementById('read-more').addEventListener('click', showPrivacyInfo);

        // Écouter le clic sur le bouton Supprimer les Cookies
        document.getElementById('delete-cookies').addEventListener('click', deleteCookies);

        // Écouter le clic sur la croix pour fermer la bannière
        document.getElementById('close-banner').addEventListener('click', hideManageCookiesBanner);
    }

    // Fonction pour afficher les informations sur la politique de confidentialité
    function showPrivacyInfo() {
        // Création du bloc d'information au centre de la page
        const privacyInfoBlock = document.createElement('div');
        privacyInfoBlock.id = 'privacy-info-block';
        privacyInfoBlock.className = 'privacy-info-block'; // Ajout de classe CSS pour le style
        privacyInfoBlock.innerHTML = `
            <h2>Politique de confidentialité des cookies</h2>
            <p>Insérer ici vos informations détaillées sur la politique de confidentialité des cookies et autres détails pertinents.</p>
            <p>Ce bloc peut contenir du texte, des liens, des images, etc., en fonction de vos besoins.</p>
            <button id="close-info" class="pointer">Fermer</button>
        `;
        document.body.appendChild(privacyInfoBlock);

        // Écouter le clic sur le bouton Fermer
        document.getElementById('close-info').addEventListener('click', function() {
            document.getElementById('privacy-info-block').remove();
        });
    }

    // Fonction pour masquer la bannière de gestion des cookies
    function hideManageCookiesBanner() {
        const manageCookiesBanner = document.getElementById('manage-cookies-banner');
        if (manageCookiesBanner) {
            manageCookiesBanner.style.display = 'none';
        }
    }

    // Action lorsque l'utilisateur accepte les cookies
    function acceptCookies() {
        localStorage.setItem('cookie_consent', 'accepted');
        hideCookieBanner();
        createCookieIcon(); // Créer l'icône de cookie après acceptation
    }

    // Action lorsque l'utilisateur refuse les cookies
    function rejectCookies() {
        localStorage.setItem('cookie_consent', 'rejected');
        hideCookieBanner();
    }

    // Action pour supprimer les cookies
    function deleteCookies() {
        localStorage.removeItem('cookie_consent');
        alert('Cookies supprimés.');
        hideManageCookiesBanner();
        createCookieBanner(); // Afficher à nouveau la bannière principale pour une nouvelle décision
    }

    // Appel initial pour vérifier le consentement des cookies
    checkCookieConsent();

});
