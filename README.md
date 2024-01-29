Ceci est le ReadMe contenant des informations sur le projet afin de faciliter son évaluation.


Liens des projets déployé
-
  - BackEnd (API) : https://webinfo.iutmontp.univ-montp2.fr/~campsa/ProjetApiSymfony/public/api
  - My Avatar     : https://webinfo.iutmontp.univ-montp2.fr/~pujadej/ProjetWebSymphonyMyAvatar/public/index
  - FrontEnd      : https://webinfo.iutmontp.univ-montp2.fr/~depeyreg/ProjetFrontSymfony/

Liens des projets GitHub
-
  - BackEnd (API) : https://github.com/LunyaticCat/ProjetApiSymfony
  - My Avatar     : https://github.com/LunyaticCat/ProjetWebSymphonyMyAvatar
  - FrontEnd      : https://github.com/LunyaticCat/ProjetFrontSymfony

Présentation du thème choisi
-
Le thème que nous avons choisi était Terraria.
Le jeu Terraria propose des complexités intéressantes du fait que des stacks d'items sont requis pour pouvoir concevoir un objet, et qu'un même objet peut être conçu de plusieurs manières
en fonction de si le monde est "Tainted" ou "Corrupted", et peuvent ainsi amener à un objet similaire pouvant être créé avec des composants différent, dans des tables différentes, ce qui mal
amené pourrai conduire à une explosion exponnentiel du nombre de craft stocké en base de donnée pour un seul objet.

Présentation de l'API
-
(expliquer le système mis en place pour la bd et quels chemin utiliser)
L'API repose sur une conceptualisation de la base de données dans laquelle un craft d'item correspond en fait à un item_group définissant si l'objet est un item permettant le craft (table de craft) ou un composant quelconque.
Ensuite, un group_fragment vient lier chaque item à leurs groupes et leurs attribut le nombre requis pour le craft. Enfin, le craft lie l'utilisateur qui a créé un craft à ce dernier et l'item qui lui est associé.
On peut faire ces manipulations dans l'ordre avec les liens suivants :
```
1)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/users
1.5) https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/categories (optionel)
2)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/items
3)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/crafts
4)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/item_groups
5)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/group_fragments
```

Présentation du Front
-
La majeure partie du front se compose de requêtes à l'API avec une interface. Le code pour l'affichage, une famille d'items (ItemTree.vue), présente un intérêt particulier, il s'agit d'afficher de manière récursive un arbre de construction d'objet. La connexion avec MyAvatar se fait par un hash de l'email de l'utilisateur via l'algorithme MD5.


Présentation de MyAvatar
-
MyAvatar est un service permettant la gestion des photos de profil des utilisateurs de notre application.

Pour récupérer la photo de profil liée à un compte, il suffit d'utiliser la route qui suit :

`/avatar/{hashMD5Email}`

Par exemple, cette route :

`https://webinfo.iutmontp.univ-montp2.fr/~pujadej/ProjetWebSymphonyMyAvatar/public/avatar/d2da44a8f89b8f0485602e27b28a94ab`

Si le paramètre de la route est mauvais, ou que l'utilisateur n'existe pas, une photo de profil par défaut (anonyme.jpg) sera renvoyée.

Récapitulatif de l'investissement
-
- Gatien s'est consacré au front et a participé à l'ajout de chacune des fonctionnalités de ce dernier. Il a également créé un installateur pour que chaque membre puisse installer localement sans difficulté le Front. Malgré les problèmes qui sont survenu, il a tenté au mieux de s'occuper de la gestion du projet, organiser des réunions et suivre le GitHub Project. 
- Gatien et Yann ont pu concevoir la structure de la base de données.
- Yann a pu assister sur le refactoring du code du front et revoir sa charte graphique CSS, mettre en place la base de données conceptualisée sur l'API, et commencer le système de mot de passe de l'API puis a contribué au débugage de ce dernier.
  Il a également été responsable de préparer le rendu des projets et a fait l'intégration du projet MyAvatar au projet Front. Il a également rajouté un système de lecture d'erreur pour la page login et inscription du Front.
- Joffrey a mis en place le projet MyAvatar afin que ce dernier puisse être lié au Front.
- Alexis a avancé le mot de passe de l'API.

Identifiants de compte (il faut récupérer le code d'alexis puis ajouter les mot de passes à cette partie)
-
(Admin)<br>
  username : ``test``<br>
  password : ``1Bze@``<br>
(User)<br>
  username : ``testa``<br>
  password : ``1Bze@``<br>

Indications supplémentaire
-
Vous pourrez trouver un fichier install.sh pour le projet Vue.js (Front) permettant de facilement ajouter les fichiers requis afin de facilement faire tourner le site en local
