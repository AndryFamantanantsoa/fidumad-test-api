<template>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">Liste des opérations</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="calcul-tab" data-bs-toggle="tab" data-bs-target="#calcul" type="button" role="tab" aria-controls="calcul" aria-selected="false">Total</button>
            </li>
            
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                    <th scope="col">LABEL</th>
                    <th scope="col">RIB</th>
                    <th scope="col">DATE</th>
                    <th scope="col">MONTANT</th>
                    <th :class="classAttrib">RECETTES</th>
                    <th :class="classAttrib">DEPENSES</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in getfilterdRib" v-bind:key="item.id">
                    <th scope="row">{{ item.label }}</th>
                    <td>{{ item.rib }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.amount }}</td>
                    <td :class="classAttrib"><span v-if="item.amount >= 0"> {{ item.amount }}</span><span v-else>0</span></td>
                    <td :class="classAttrib"><span v-if="item.amount < 0">{{ Math.abs(item.amount) }}</span><span v-else>0</span></td>
                    
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="calcul" role="tabpanel" aria-labelledby="calcul-tab">
            <TotalRecette :recette="parseFloat(recette).toFixed(2)" :depense="parseFloat(depense).toFixed(2)"/>
            </div>
            
        </div>
        
    </div>
</template>
<script>
import TotalRecette from './TotalRecette.vue'

export default {
    name: 'ListOperations',
    components: {
        TotalRecette
    },
    props: {
        valribProp: {
            type: String
        },
        valdate1Prop: {
            type: String
        },
        valdate2Prop: {
            type: String
        },
    },

    data () {
        return {
            lists: [],
            valrib: this.valribProp,
            valdate1: this.valdate1Prop,
            valdate2: this.valdate2Prop,
            classAttrib: 'd-none',
            recette: 0,
            depense: 0
        }
    },

    methods: {

        // pour formater les dates
        localizeDate(date) {
            
            if (!date || !date.includes('/')) return date
            const [yyyy, mm, dd] = date.split('-')
            return new Date(`${yyyy}-${mm}-${dd}`)
        },

        calcTotal (val) {
            this.recette += val >= 0 ? val : 0
            this.depense += val < 0 ? Math.abs(val) : 0

        }

    },

    watch: {

        valribProp: function (newVal) {
            this.valrib = newVal
            this.getfilterdRib
        },
        valdate1Prop: function (newVal) {
            
            this.valdate1 = newVal
            this.getfilterdRib
        },
        valdate2Prop: function (newVal) {
            this.valdate2 = newVal
            this.getfilterdRib
        }
    },

    computed: {

        //retourne la liste par rapport aux critères
        getfilterdRib () {
            this.recette = 0
            this.depense = 0
            let filterRib = this.valrib;
            let startDate = this.localizeDate(this.valdate1);
            let endDate = this.localizeDate(this.valdate2);
            this.sortList
            const itemsByRib = filterRib ? this.lists.filter(item => item.rib === filterRib) : this.lists
            return itemsByRib.filter (rib => {
                
                const itemDate = this.localizeDate(rib.date);
                if (startDate && endDate) {
                    this.classAttrib = ""
                    if (startDate <= itemDate && itemDate <= endDate)
                    {
                        this.calcTotal(rib.amount)
                    }
                    return startDate <= itemDate && itemDate <= endDate;
                }
                if (startDate && !endDate) {
                    this.classAttrib = ""
                    if (startDate <= itemDate)
                    {
                        this.calcTotal(rib.amount)
                    }
                    return startDate <= itemDate;
                }
                if (!startDate && endDate) {
                    this.classAttrib = ""
                    if (itemDate <= endDate)
                    {
                        this.calcTotal(rib.amount)
                    }
                    return itemDate <= endDate;
                }
                 this.classAttrib = "d-none"
                return true;
            })
        },

        //retourne une liste ordonnée par date
        sortList () {
            function compare(a, b) {
            if (a.date < b.date)
                return -1;
            if (a.name > b.name)
                return 1;
            return 0;
            }

            return this.lists.sort(compare);
        }
    }

}
</script>
