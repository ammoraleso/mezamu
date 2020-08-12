<template>
    <div>
        <div class="d-flex justify-content-around">
            <div class="card p-3">
                <h3 class="text-center font-weight-bolder mb-3">Nuevas Ordenes</h3>
                <span v-for="order in orders">
                    <div v-if="order.order.status == 0" class="card mb-3" :class="order.order.type == 'delivery' ? 'bg-primary text-white' : ''" style="max-width: 20rem;">
                        <div class="card-header font-weight-bold">Orden: {{order.order.id}}</div>
                        <div class="card-body">
                            <div v-for="item in order.items">
                                <p class="card-text">{{item.quantity}} | {{item.dish_branch.dish.name}}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p v-if="order.order.type == 'delivery'" class="font-weight-bold">Domicilio</p>
                            <p class="font-weight-bold">Total: ${{Intl.NumberFormat().format(order.order.total)}}</p>
                            <p class="font-weight-bold">Lugar: {{order.order.place}}</p>
                        </div>
                    </div>
                </span>
            </div>
            <div class="card">
                <h3 class="text-center">En Preparación</h3>
            </div>
            <div class="card">
                <h3 class="text-center">Listas</h3>
            </div>
        </div>
    </div>
</template>

<script type="application/javascript">
    export default {
        props:['branchid','databaseorders'],
        data(){
            return{
                orders: this.databaseorders
            }
        },
        mounted() {
            console.log('Component mounted.')
            Echo.private('App.Models.Branch.'+ this.branchid)
                .notification((notification) => {
                    //console.log(notification.items[0].dishBranch);//For debug
                    this.orders.push(notification);
                });
        }
    }
</script>
