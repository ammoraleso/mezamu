<template>
    <div>
        <div class="d-flex justify-content-around">
            <div class="card">
                <h3>Nuevas Ordenes</h3>
                <p v-for="order in orders" class="dropdown-item break-word notification-item floating-card">nueva orden</p>
            </div>
            <div class="card">
                <h3>En Preparación</h3>
            </div>
            <div class="card">
                <h3>Listas</h3>
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
                    console.log(notification);
                    this.orders.push('hola');
                });
        }
    }
</script>
