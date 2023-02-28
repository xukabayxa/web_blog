<script>
    class CategorySpecial extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {

        }



        get submit_data() {
            let data = {
                name: this.name,
                code: this.code,
                type: this.type,
                order_number: this.order_number,
                show_home_page: this.show_home_page,
            }
            data = jsonToFormData(data);

            return data;
        }
    }
</script>
