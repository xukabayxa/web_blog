<script>
    class Partner extends BaseClass {
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
                is_show: this.is_show,
                cate_ids: this.cate_ids,

            }
            data = jsonToFormData(data);

            let image = this.image.submit_data;
            if (image) data.append('image', image);

            return data;
        }
    }
</script>
