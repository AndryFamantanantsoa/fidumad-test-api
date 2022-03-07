<template>
<div class="container">
    <h1>Solde de compte <span class="badge bg-info text-dark">{{ this.recette - this.depense }}</span></h1>
    <h3>Total des recettes <span class="badge bg-success">{{ this.recette }}</span></h3>
    <h3>Total des dépenses <span class="badge bg-danger">{{ this.depense }}</span></h3>
</div>
</template>

<script>

  export default {
    name: 'TotalRecette',

    props: {
        recette: {
            type: String,
            default: "0.00"
        },
        depense: {
            type: String,
            default: "0.00"
        }
    }
  };
</script>