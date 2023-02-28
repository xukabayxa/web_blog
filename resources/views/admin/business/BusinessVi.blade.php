<script>
    class BusinessVi extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {
        }


        get submit_data() {
            let data = {
                title: this.title,
                description: this.description,
            }

            return data;
        }
    }
</script>
