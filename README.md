# CloudOps - Projet final - semaine du 15/11/2021
## Présentation
L’entreprise Nuvola dispose actuellement d’une application symfony hébergée sur site et déployée manuellement dans différents environnements (dev, prod). 
Sources de l’application + dump.sql : https://github.com/cdufour/nuvola/

Nuvola rencontre deux problématiques majeures:
au niveau des mises à jour de son app (redéploiement), jugées actuellement trop longues et nécessitant trop d’étapes manuelles
au niveau des performances de l’application qui ralentit souvent en cas de forte affluence et qui parfois connaît des interruptions de services dommageables sur un plan commercial.

Nuvola a entendu parler des caractéristiques propres au cloud (scalabilité, haute dispo, etc.). Elle requiert vos services pour l’aider à leur apporter une solution à ses problèmes.

Elle met donc à votre disposition les sources de son application + dump de sa base de données et vous assigne la tâche de migrer son application vers le cloud AWS.

L’expression des besoins se résume ainsi:
- possibilité pour un administrateur (vous) de fournir automatiquement à un collaborateur (développeur) un    environnement de travail uniformisé (machine ec2) dans le cloud avec communication de ses accès. 
  - cet environnement contiendra une copie du dépôt
  - le développeur devra pouvoir tester localement l’application (avec une base de données local), idéalement sous une forme conteneurisée
- permettre aux collaborateurs d’apporter leur contribution au code source de l’application sur une branche spécifique (exemple: branche ‘new_features’)
- possibilité de (re)déployer l’application en environnement dev/prod le plus rapidement et automatiquement possible
- offrir une garantie de continuité de service de l’application, de disponibilité et d’adaptabilité en cas de charge de travail fluctuante.
- un administrateur (vous), depuis sa propre machine dans le cloud, doit pouvoir aisément contrôler l’ensemble de machines des développeurs afin, par exemple, de pouvoir effectuer des installations, copie de fichiers,  vérification diverses, etc., sur l’ensemble des machines.


## Notes 
### Base de données.
Nuvola souhaite que sa base de données soit déclinée en une version de production et une version de développement, toutes deux également placées dans AWS.
Les développeurs, qui pourront tester localement l’application, devront pouvoir alimenter leur instance de base de données locale (conteneur) par récupération du dernier dump de production disponible.

### Accès
Un développeur ne pourra pas accéder aux machines des autres développeurs ni, bien sûr, à la machine admin.

### Modalités de travail
Dans le cadre de ce projet, vous devez convoquer une grande partie des connaissances accumulées, des concepts et des outils abordés durant le cursus.

Vous serez répartis en 3 groupes.

Groupe 1: Pamela, Alexandre, Brice
Groupe 2: Alyssia, Brice, Sébastien
Groupe 3: Aude, Pierre, Jocelyn

Vous présenterez le projet en fin de semaine (vendredi).
Durée de la présentation: 30-45 min pour groupe.

Il se peut que d’autres tâches vous soient demandées en cours de semaine ;-)

Vous devrez démontrer le bon fonctionnement de votre architecture et justifier vos choix techniques.
