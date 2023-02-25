<template>
  <div class="horizontal-scrollable">
    <div class="row justify-content-around">
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">Nuevas Ordenes</h3>
        <span v-for="(order, index) in orders" style="width: 90%">
          <div
            v-if="order.order.status == 0"
            class="card mb-3"
            :class="
              order.order.type == 'delivery' ? 'bg-primary text-white' : ''
            "
          >
            <div class="card-header font-weight-bold">
              Orden: {{ order.order.id }}
            </div>
            <div class="card-body">
              <div class="row" style="justify-content: space-between;" v-for="item in order.items">
                <div class="column">
                  <p class="card-text" id="nameDish1">
                    {{ item.quantity }} | {{ item.dish_branch.dish.name }}
                  </p>
                </div>
                <div v-if="order.order.type != 'delivery'" class="column">
                  <input  @click="updateCheck(item)"  type="checkbox" :checked="item.delivered == 1">
                </div>
              </div>
            </div>
            <div class="card-footer" style="white-space: initial">
              <p
                v-if="order.order.type == 'delivery'"
                class="font-weight-bold"
              >
                Lugar: {{ order.order.place }} -
              </p>
              <p v-else class="font-weight-bold">
                Lugar: {{ order.order.place }}
              </p>
              <p v-if="order.order.annotations != ''" class="font-weight-bold">
                Anotaciones: {{ order.order.annotations }}
              </p>
              <p class="font-weight-bold">
                Total: ${{ Intl.NumberFormat().format(order.order.total) }}
              </p>
              <p class="font-weight-bold">
                Tipo Pago: {{ order.order.payment_type }}
              </p>
              <p v-if="order.order.created_at != ''" class="font-weight-bold">
                Hora Creacion: {{ order.order.date }}
              </p>
              <button class="btn btn-success" @click="forward(index)">
                Continuar
              </button>
            </div>
          </div>
        </span>
      </div>
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">En Preparación</h3>
        <span v-for="(order, index) in orders" style="width: 90%">
          <div
            v-if="order.order.status == 1"
            class="card mb-3"
            :class="
              order.order.type == 'delivery' ? 'bg-primary text-white' : ''
            "
          >
            <div class="card-header font-weight-bold">
              Orden: {{ order.order.id }}
            </div>
            <div class="card-body">
             <div class="row" style="justify-content: space-between;" v-for="item in order.items">
                <div class="column">
                  <p class="card-text" id="nameDish2">
                    {{ item.quantity }} | {{ item.dish_branch.dish.name }}
                  </p>
                </div>
                <div v-if="order.order.type != 'delivery'" class="column">
                  <input  @click="updateCheck(item)"  type="checkbox" :checked="item.delivered == 1">
                </div>
              </div>
            </div>
            <div class="card-footer" style="white-space: initial">
              <p v-if="order.order.type == 'delivery'" class="font-weight-bold">
                Domicilio
              </p>
              <p
                v-if="order.order.customer && order.order.customer.direccion_adicional && order.order.type == 'delivery'"
                class="font-weight-bold"
              >
                Lugar: {{ order.order.place }} -
                {{ order.order.customer.direccion_adicional }}
              </p>
              <p v-else class="font-weight-bold">
                Lugar: {{ order.order.place }}
              </p>
              <p v-if="order.order.customer" class="font-weight-bold">
                Cliente: {{ order.order.customer.nombre }}
              </p>
              <p v-if="order.order.annotations != ''" class="font-weight-bold">
                Anotaciones: {{ order.order.annotations }}
              </p>
              <p class="font-weight-bold">
                Total: ${{ Intl.NumberFormat().format(order.order.total) }}
              </p>
              <p class="font-weight-bold">
                Tipo Pago: {{ order.order.payment_type }}
              </p>
              <p v-if="order.order.created_at != ''" class="font-weight-bold">
                Hora Creacion: {{ order.order.date }}
              </p>
              <button class="btn btn-info" @click="back(index)">
                Devolver
              </button>
              <button class="btn btn-success" @click="forward(index)">
                Continuar
              </button>
            </div>
          </div>
        </span>
      </div>
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">Listas</h3>
        <span v-for="(order, index) in orders" style="width: 90%">
          <div
            v-if="order.order.status == 2"
            class="card mb-3"
            :class="
              order.order.type == 'delivery' ? 'bg-primary text-white' : ''
            "
          >
            <div class="card-header font-weight-bold">
              Orden: {{ order.order.id }}
            </div>
            <div class="card-body">
              <div class="row" style="justify-content: space-between; " v-for="item in order.items">
                <div class="column">
                  <p class="card-text" id="nameDish1">
                    {{ item.quantity }} | {{ item.dish_branch.dish.name }}
                  </p>
                </div>
                <div v-if="order.order.type != 'delivery'" class="column">
                  <input  @click="updateCheck(item)"  type="checkbox" :checked="item.delivered == 1">
                </div>
              </div>
            </div>
            <div class="card-footer" style="white-space: initial">
              <p v-if="order.order.type == 'delivery'" class="font-weight-bold">
                Domicilio
              </p>
              <p
                v-if="order.order.customer && order.order.customer.direccion_adicional && order.order.type == 'delivery'"
                class="font-weight-bold"
              >
                Lugar: {{ order.order.place }} -
                {{ order.order.customer.direccion_adicional }}
              </p>
              <p v-else class="font-weight-bold">
                Lugar: {{ order.order.place }}
              </p>
              <p v-if="order.order.customer" class="font-weight-bold">
                Cliente: {{ order.order.customer.nombre }}
              </p>
              <p v-if="order.order.annotations != ''" class="font-weight-bold">
                Anotaciones: {{ order.order.annotations }}
              </p>
              <p class="font-weight-bold">
                Total: ${{ Intl.NumberFormat().format(order.order.total) }}
              </p>
              <p class="font-weight-bold">
                Tipo Pago: {{ order.order.payment_type }}
              </p>
              <p v-if="order.order.created_at != ''" class="font-weight-bold">
                Hora Creacion: {{ order.order.date }}
              </p>
              <button class="btn btn-info" @click="back(index)">
                Devolver
              </button>
              <button class="btn btn-success" @click="forward(index)">
                Continuar
              </button>
            </div>
          </div>
        </span>
      </div>
    </div>
  </div>
</template>

<script type="application/javascript">
export default {
  props: ["branchid", "databaseorders"],
  data() {
    return {
      orders: this.databaseorders,
    };
  },
  mounted() {
      console.log("Component mounted, listening: " + this.branchid);
      Echo.private("App.Models.Branch." + this.branchid).notification(
      (notification) => {
        console.log("notification listened" + notification.items[0].dishBranch);//For debug
        this.orders.push(notification);
      }
    );
  },
  methods: {
    async forward(index) {
      let order;
      order = this.orders[index];
      order.order.status += 1;
      await updateStatus(order.order);
    },
    async back(index) {
      let order;
      order = this.orders[index];
      order.order.status -= 1;
      await updateStatus(order.order);
    },
    async updateCheck(orderDish){
      if(orderDish.delivered==1){
        orderDish.delivered = 0;
      }else{
        orderDish.delivered = 1;
      }
      await updateDelivery(orderDish);
    }
  },
};
</script>
