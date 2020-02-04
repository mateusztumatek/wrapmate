import Uploader from './uploader-component';
import vue from 'vue';
export default {
    install: (Vue, options) => {
        Vue.prototype.$uploader = () => {
            return new Promise((resolve, reject) => {
                  const elem = new Vue({
                      methods:{
                          startLoading(){
                              console.log('START');
                              this.$eventBus.$emit('startLoading');
                          },
                          stopLoading(){
                              console.log('STOP');

                              this.$eventBus.$emit('stopLoading');
                          },
                          closeHandler(arg){
                              resolve(arg);
                              return function() {
                                  elem.$destroy();
                                  elem.$el.remove();
                              };
                          }
                      },
                      render(h){
                          return h(Uploader, {
                              on:{
                                  startUpload: this.startLoading,
                                  stopUpload: this.stopLoading,
                                  uploaded: this.closeHandler
                              }
                          });
                      }
                  }).$mount();
                  document.body.appendChild(elem.$el);
            })
        }
    }
}
