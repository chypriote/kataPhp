# Cart Pricing Kata

## Mission
Corriger le code pour que tous les tests passent.

### Règles métier
- Prix en centimes (int)
- TVA 20% après remise
- Remise 20% le Black Friday (dernier vendredi de novembre)
- Quantités et IDs valides
- Total TTC non négatif

### Commandes
```bash
composer install
vendor/bin/phpunit
```

### Livrables
- Repo GitHub avec tout le code
- README résumant les actions menaient
- Tests exécutables
- CI (en bonus)


### Actions menées

- Ajout d'une vérification dans le constructeur de Product pour que le prix et l'id soient valides
- Typage fort sur le priceCent pour n'accepter que des int et un prix en centimes
- Correction du DiscountService pour sélectionner le mois correct et renvoyer 0 pour les autres mois
- Changement du calcul du total: application des discounts avant le calcul de la TVA
- Ajout d'une CI github
