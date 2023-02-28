<script>
    class Market extends BaseClass {
        no_set = [];
        statuses = @json(\App\Model\Admin\Partner::STATUSES);

        before(form) {
            this.image = {};
        }

        after(form) {

        }

        // Ảnh đại diện
        get image() {
            return this._image;
        }

        set image(value) {
            this._image = new Image(value, this);
        }

        clearImage() {
            if (this.image) this.image.clear();
        }

        get submit_data() {
            let data = {
                name: this.name,
                code: this.code,
                order: this.order,
                des: this.des,
                is_show: this.is_show,
                en_name: this.en_name,
                en_des: this.en_des,
            }
            data = jsonToFormData(data);

            let image = this.image.submit_data;
            if (image) data.append('image', image);

            return data;
        }
    }
</script>
