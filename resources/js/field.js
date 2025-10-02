import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'
import PreviewField from './components/PreviewField'

Nova.booting((app, store) => {
  app.component('index-nova-fa-icon', IndexField)
  app.component('detail-nova-fa-icon', DetailField)
  app.component('form-nova-fa-icon', FormField)
  // app.component('preview-nova-fa-icon', PreviewField)
})
