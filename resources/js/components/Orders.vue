<template>
  <div class="horizontal-scrollable">
    <div class="row justify-content-around">
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">Nuevas Ordenes</h3>
        <span v-for="(order, index) in orders" style="width: 90%;">
          <div
            v-if="order.order.status == 0"
            class="card mb-3"
            :class="order.order.type == 'delivery' ? 'bg-primary text-white' : ''"
          >
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
              <button class="btn btn-success" @click="forward(index)">Continuar</button>
            </div>
          </div>
        </span>
      </div>
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">En Preparación</h3>
        <span v-for="(order, index) in orders" style="width: 90%;">
          <div
            v-if="order.order.status == 1"
            class="card mb-3"
            :class="order.order.type == 'delivery' ? 'bg-primary text-white' : ''"
          >
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
              <button class="btn btn-info" @click="back(index)">Devolver</button>
              <button class="btn btn-success" @click="forward(index)">Continuar</button>
            </div>
          </div>
        </span>
      </div>
      <div class="card align-items-center p-3 col-4">
        <h3 class="text-center font-weight-bolder mb-3">Listas</h3>
        <span v-for="(order, index) in orders" style="width: 90%;">
          <div
            v-if="order.order.status == 2"
            class="card mb-3"
            :class="order.order.type == 'delivery' ? 'bg-primary text-white' : ''"
          >
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
              <button class="btn btn-info" @click="back(index)">Devolver</button>
              <button class="btn btn-success" @click="forward(index)">Continuar</button>
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
    console.log("Component mounted.");
    Echo.private("App.Models.Branch." + this.branchid).notification(
      (notification) => {
        //console.log(notification.items[0].dishBranch);//For debug
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
  },
};
</script>
