<template>
<div class="dashboard">
    <button><router-link to="/Reservation">Return</router-link></button>
    <div>
        
    </div>
</div>
</template>
<style scoped lang="scss">

#dashboard {
  padding: 30px;
  color: white;
 text-decoration: none;

  a {
    font-weight: bold;
    color: #ffffff;
    text-decoration: none;
    border: 1px dotted rgb(86, 85, 170);
    border-radius: 20px;
    border-spacing: 1px;
    padding: 10px;
    margin: 10px;
    &.router-link-exact-active {
      color: #ffffff;
    }
}:hover {
      background-color: #aeb7df;
    }
  }
</style>