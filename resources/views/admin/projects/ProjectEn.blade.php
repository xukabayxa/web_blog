<script>
    class ProjectEn extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {

        }

        get submit_data() {
            let data = {
                title: this.title,
                des: this.des,
                short_des: this.short_des,
                address: this.address,
            }

            return data;
        }
    }
</script>
