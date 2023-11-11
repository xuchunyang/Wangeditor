import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-wangeditor', IndexField)
  app.component('detail-wangeditor', DetailField)
  app.component('form-wangeditor', FormField)
})
