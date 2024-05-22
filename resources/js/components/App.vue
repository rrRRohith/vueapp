<template>
  <div class="w-100 container">
    <div>
      <router-view class="p-6 " v-slot="{ Component }">
        <component :is="Component" />
      </router-view>
    </div>
  </div>
</template>

<script>
export default {

}
</script>