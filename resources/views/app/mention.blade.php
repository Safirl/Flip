@vite(['resources/css/mentions.scss'])

<x-layouts.base title="Mentions légales">
    <header>
        <a href="{{ url()->previous() }}">
            <img src="{{ asset('/images/icons/back.svg') }}" alt="Retour">
        </a>

        <h1 class="title">Mentions legales</h1>
    </header>
    <main>


        <h2>Identité</h2>
        <ul>
            <li>
                Adresse : 1 Rue Jacques Ellul, 33800 Bordeaux
            </li>
            <li>
                Adresse e-mail : flipyourchoice.app@gmail.com
            </li>
            <li>
                Numéro de téléphone : +33 6 33 48 71 69
            </li>
        </ul>

        <h2>Conception</h2>
        <ul>
            <li> Création : Flip corp.</li>
            <li> Crédits visuels : Flip corp.</li>
        </ul>

        <h3>Équipe</h3>
        <ul>
            <li>Joséphine SAINT-YGNAN</li>
            <li>Hugo MENSAH</li>
            <li>Driss LOUDIYI </li>
            <li>Coralie ALEXANDRU</li>
            <li>Chloé FAYE</li>
            <li>Loïc LEFORESTIER</li>
            <li>Héloïse PINGOTORE</li>

        </ul>

        <h2>Conditions Générales d’Utilisation (CGU)</h2>
        <p>
            L’accès à cette application web signifie l’acceptation des présentes CGU.
        </p>
        <p>
            En utilisant notre site, l’utilisateur s’engage à respecter les conditions générales d’utilisation du site
            suivantes.
        </p>

        <h2>Propriété intellectuelle</h2>
        <p>
            Tous les éléments présents sur le site (photographie, logo, illustration, son, design, article) sont
            protégés par la loi en vigueur au titre de la propriété intellectuelle.
        </p>
        <p>
            Chaque auteur respectif est en droit de réutiliser leurs créations pour des projets commerciaux ou non.
        </p>
        <p>
            En effet, toute reproduction ou utilisation est strictement interdite sans accord au préalable de
            l'éditeur.
        </p>
        <p>
            La reproduction et la copie des contenus par l'utilisateur requièrent une autorisation préalable du site.
            Dans ce cas, toute utilisation à des usages commerciaux ou à des fins publicitaires est proscrite.
        </p>

        <h2>
            Champ d’application / contenu utilisateur
        </h2>
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

        <p>
            Pour des raisons de maintenance ou autres, l’accès au site peut être interrompu ou suspendu par l’éditeur
            sans préavis ni justification.
        </p>

        <h2>Responsabilité</h2>
        <p>
            Bien que les informations publiées sur le site soient réputées fiables, le site se réserve la faculté d’une
            non-garantie de la fiabilité des sources.
        </p>
        <p>
            Les informations diffusées sur l’application web Flip sont présentées à titre purement informatif et sont
            sans
            valeur contractuelle. En dépit des mises à jour, la responsabilité de l’application web ne peut être engagée
            en
            cas de modification des dispositions administratives et juridiques apparaissant après la publication.
        </p>
        <p>
            Celle-ci décline toute responsabilité concernant les éventuels virus pouvant infecter le matériel
            informatique
            de l'utilisateur après l’utilisation ou l’accès à Flip.
        </p>
        <p>
            Flip et Flip corp. ne peut être tenu pour responsable en cas de force majeure ou du fait imprévisible et
            insurmontable d’un tiers.
        </p>
        <p>
            La garantie totale de la sécurité et la confidentialité des données n’est pas assurée par l’application web.
            Cependant, Flip corp. s’engage à mettre en œuvre toutes les méthodes requises pour le faire au mieux dans
            les
            meilleurs délais.
        </p>
    </main>


    <footer>
        <img class="logo" src="{{asset('../images/logo.svg')}}" alt="">
        <p>Flip CORP.</p>
    </footer>
</x-layouts.base>
