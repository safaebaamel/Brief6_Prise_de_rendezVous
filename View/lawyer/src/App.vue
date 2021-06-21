<template>
  <div id="nav">
    <router-link to="/">New Visitor?</router-link> |
    <router-link to="/about">Take a Slot!</router-link>
  </div>
  <router-view/>
</template>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;
    text-decoration: none;
    border: 1px dotted rgb(86, 85, 170);
    border-radius: 20px;
    border-spacing: 1px;
    padding: 10px;
    margin: 10px;
    &.router-link-exact-active {
      color: #283672;
    }
}:hover {
      background-color: #aeb7df;
    }
  }

</style>
