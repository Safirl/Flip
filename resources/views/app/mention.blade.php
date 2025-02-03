@vite(['resources/css/mentions.css'])

<x-layouts.base-with-nav title="Mentions légales">
    <div class="mentions-legales">
        <div class="title-bar">
            <form action="{{ url()->previous() }}"
                  method="get">
                <x-button
                    size="large"
                    color="primary"
                    kind="outlined"
                    iconEnd="fa-solid fa-arrow-left"
                />
            </form>
            <h1 class="title" style="">Mentions légales</h1>
        </div>
        <p>
            Adresse : 1 Rue Jacques Ellul, 33800 Bordeaux <br>
            Adresse e-mail : flipyourchoice.app@gmail.com<br>
            Numéro de téléphone : +33 6 33 48 71 69<br>
        </p>

        <p><strong>Conception</strong></p>
        <p>
            Création : Flip corp. <br>
            Crédits visuels : Flip corp. <br>
            Flip corp. composé de :  <br> <br>

            Joséphine SAINT-YGNAN <br>
            Hugo MENSAH <br>
            Driss LOUDIYI  <br>
            Coralie ALEXANDRU <br>
            Chloé FAYE <br>
            Loïc LEFORESTIER <br>
            Héloïse PINGOTORE <br>

        </p>
        <p><strong>Conditions Générales d’Utilisation (CGU)</strong></p>

        <p>
            L’accès à cette application web signifie l’acceptation des présentes CGU.<br>
            En utilisant notre site, l’utilisateur s’engage à respecter les conditions générales d’utilisation du site
            suivantes. <br>

        </p>

        <p><strong>Propriété intellectuelle</strong></p>

        <p>
            Tous les éléments présents sur le site (photographie, logo, illustration, son, design, article) sont
            protégés
            par la loi en vigueur au titre de la propriété intellectuelle.<br>
            Chaque auteur respectif est en droit de réutiliser leurs créations pour des projets commerciaux ou non. <br>
            En effet toute reproduction ou utilisation est strictement interdite sans accord au préalable de
            l'éditeur.<br>
            La reproduction et la copie des contenus par l'utilisateur requièrent une autorisation préalable du site.
            Dans
            ce cas, toute utilisation à des usages commerciaux ou à des fins publicitaires est proscrite. <br>

        </p>

        <p><strong>Champ d’application / contenu utilisateur</strong></p>

        <p>
            Description des services : Flip est une application web réalisée lors d'un projet universitaire. Celle-ci
            repose
            sur l’idée d’informer les jeunes sur la politique en leur offrant une plateforme interactive et éducative.
            Son
            ADN est de rendre l’information politique accessible, factuelle et de lutter contre la désinformation tout
            en
            débattant avec ses amis grâce à des sondages en direct et les débats en groupe, tout ça démêlant l’intox de
            l’info.

        </p>

        <p>Pour des raisons de maintenance ou autres, l’accès au site peut être interrompu ou suspendu par l’éditeur
            sans
            préavis ni justification.</p>

        <p><strong>Responsabilité</strong></p>

        <p>
            Bien que les informations publiées sur le site soient réputées fiables, le site se réserve la faculté d’une
            non-garantie de la fiabilité des sources. <br>
            Les informations diffusées sur l’application web Flip sont présentées à titre purement informatif et sont
            sans
            valeur contractuelle. En dépit des mises à jour, la responsabilité de l’application web ne peut être engagée
            en
            cas de modification des dispositions administratives et juridiques apparaissant après la publication.<br>
            Celle-ci décline toute responsabilité concernant les éventuels virus pouvant infecter le matériel
            informatique
            de l'utilisateur après l’utilisation ou l’accès à Flip. <br>
            Flip et Flip corp. ne peut être tenu pour responsable en cas de force majeure ou du fait imprévisible et
            insurmontable d’un tiers.<br>
            La garantie totale de la sécurité et la confidentialité des données n’est pas assurée par l’application web.
            Cependant, Flip corp. s’engage à mettre en œuvre toutes les méthodes requises pour le faire au mieux dans
            les
            meilleurs délais.<br>

        </p>

        <div class="mentions-legales-footer">
            <img class="logo" src="{{asset('../images/logo.svg')}}" alt="logo de Flip">
            <p><strong>Flip CORP.</strong></p>
        </div>
    </div>
</x-layouts.base-with-nav>
