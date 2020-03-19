<template>
<div class="col-3">
  <v-card
    class="mx-auto"
    max-width="500"
    flat
    outlined
  >
    <v-list dense>
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>Filter  <v-icon small class="ml-auto">mdi-filter</v-icon></v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-divider></v-divider>
      <v-list-item-group
        v-model="model"
        multiple
      >
        <template v-for="(item, i) in items">
          <v-divider
            v-if="!item"
            :key="`divider-${i}`"
          ></v-divider>

          <v-list-item
            v-else
            :key="`item-${i}`"
            :value="item"
            active-class="primary--text"
          >
            <template v-slot:default="{ active, toggle }">
              <v-list-item-content>
                <v-list-item-title v-text="item"></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action>
                <v-checkbox
                    dense
                    :input-value="active"
                    :true-value="item"
                    color="primary"
                    @click="toggle"
                ></v-checkbox>
              </v-list-item-action>
            </template>
          </v-list-item>
        </template>
      </v-list-item-group>
    </v-list>
  </v-card>
</div>
</template>

<script>
 export default {
    data: () => ({
      items: [
        'Dog Photos',
        'Cat Photos',
        '',
        'Potatoes',
        'Carrots',
      ],
      model: ['Carrots'],
    }),
  }
</script>