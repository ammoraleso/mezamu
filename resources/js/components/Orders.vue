<template>
    <div>
        <div class="d-flex justify-content-around">
            <div class="card p-3">
                <h3 class="text-center font-weight-bolder mb-3">Nuevas Ordenes</h3>
                <div v-for="order in orders">
                    <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                        <div class="card-header font-weight-bold">Header</div>
                        <div v-for="item in order.items" class="card-body">
                            <p class="card-text">{{item.quantity}} | {{item.dish_branch.dish.name}}</p>
                        </div>
                        <div class="card-footer">
                            <p class="font-weight-bold">Total: ${{Intl.NumberFormat().format(order.order.total)}}</p>
                        </div>
                    </div>
                </div>
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
        props:['branchid'],
        data(){
            return{
                orders: [],
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
