<template>
  <div class="app">
    <ckeditor 
      v-model="content" 
      :config="config" 
      @blur="onBlur($event)" 
      @focus="onFocus($event)">
    </ckeditor>
  </div>
</template>

<script>
import Ckeditor from 'vue-ckeditor2'

export default {
  components: { Ckeditor },
  data () {
    return {
      content: '',
      config: {
        toolbar: [
          [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
        ],
        height: 300
      }
    }
  },
  methods: {
    onBlur (editor) {
      console.log(editor)
    },
    onFocus (editor) {
      console.log(editor)
    }
  }
}
</script>
Multi CKEditor
<template>
  <div class="app">
    <ckeditor 
      v-model="contentA" 
      types="inline" 
      :config="configA">
    </ckeditor>
    <ckeditor 
      v-model="contentB" 
      :config="configB" 
      @blur="onBlur($event)" 
      @focus="onFocus($event)">
    </ckeditor>
  </div>
</template>

<script>
import Ckeditor from 'vue-ckeditor2'

export default {
  components: { Ckeditor },
  data () {
    return {
      contentA: '',
      configA: {
        toolbar: [[ 'Bold' ]],
        height: 300
      },
      contentB: '',
      configB: {
        toolbar: [[ 'Italic' ]],
        height: 150
      }
    }
  },
  methods: {
    onBlur (editor) {
      console.log(editor)
    },
    onFocus (editor) {
      console.log(editor)
    }
  }
}
</script>