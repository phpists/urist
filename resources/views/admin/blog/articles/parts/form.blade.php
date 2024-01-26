<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="formTitle">Заголовок</label>
            <div class="input-wrapper">
                <input id="formTitle" type="text" name="title" class="form-control" value="{{ old('title', $model->title) }}" required/>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
            <div class="form-group">
                <label for="formSlug">Посилання (slug)</label>
                <div class="input-wrapper">
                    <input type="text" class="form-control" name="slug" id="formSlug" value="{{ old('slug', $model->slug) }}">
                    <span class="form-text text-muted">Буде згенеровано автоматично, якщо залишити пустим</span>
                    @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="formSlug">Основна стаття</label>
<span class="switch justify-content-center">
								<label>
									<input class="bool-updatable" type="checkbox" @checked(old('is_main', $model->is_main)) name="is_main">
									<span></span>
								</label>
							</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="formTags">Теги</label>
            <div class="input-wrapper">
                <select multiple="multiple" class="form-control" name="tags[]" id="formTags">
                    @foreach($blogTags as $blogTag)
                        <option value="{{ $blogTag->id }}" @selected(in_array($blogTag->id, old('tags', $model->getTagsIds())))>{{ $blogTag->title }}</option>
                    @endforeach
                </select>
                @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="image-input image-input-outline" id="thumbnailImage">
            <div class="image-input-wrapper" @if($thumb = $model->getThumbnailSrc()) style="background-image: url('{{ $thumb }}')" @endif></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Змінити зображення">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" @required(empty($model->thumbnail))/>
                <input type="hidden" name="thumbnail_remove"/>
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Прибрати зображення">
		<i class="ki ki-bold-close icon-xs text-muted"></i>
	</span>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group"><label for="descriptionEditor">Короткий опис</label>
            <div class="input-wrapper">
                <textarea class="form-control" name="short_description" rows="5" required>{{ old('short_description', $model->short_description) }}</textarea>
            </div>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="contentEditor">Вміст</label>
            <div class="input-wrapper">
                <textarea class="required_inp" style="height: 600px" id="contentEditor" name="content" required>{{ old('content', $model->content) }}</textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let contentEditor = CKEDITOR.replace( 'contentEditor' );
            $("#formTags").select2({
                placeholder: "Виберіть хештеги",
            });
            let thumbnailImage = new KTImageInput('thumbnailImage');
        })
    </script>
@endpush
