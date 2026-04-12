@php
    /** @var \App\Course|null $course */
    $isEdit = isset($course) && $course->exists;
@endphp

<div class="form-group">
    <label for="course-title">Title</label>
    <input type="text" name="title" id="course-title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $course->title ?? '') }}" required maxlength="255">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-short">Short description</label>
    <textarea name="short_description" id="course-short" class="form-control @error('short_description') is-invalid @enderror"
              rows="2" required maxlength="500">{{ old('short_description', $course->short_description ?? '') }}</textarea>
    @error('short_description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-description">Full description</label>
    <textarea name="description" id="course-description" class="form-control @error('description') is-invalid @enderror"
              rows="6" required>{{ old('description', $course->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-outcomes">What students will learn (outcomes)</label>
    <textarea name="outcomes" id="course-outcomes" class="form-control @error('outcomes') is-invalid @enderror"
              rows="3" required>{{ old('outcomes', $course->outcomes ?? '') }}</textarea>
    @error('outcomes')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-section">Curriculum outline (optional)</label>
    <textarea name="section" id="course-section" class="form-control @error('section') is-invalid @enderror"
              rows="4">{{ old('section', $course->section ?? '') }}</textarea>
    @error('section')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-requirements">Requirements / prerequisites</label>
    <textarea name="requirements" id="course-requirements" class="form-control @error('requirements') is-invalid @enderror"
              rows="3">{{ old('requirements', $course->requirements ?? '') }}</textarea>
    @error('requirements')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="course-language">Language</label>
        <input type="text" name="language" id="course-language" class="form-control @error('language') is-invalid @enderror"
               value="{{ old('language', $course->language ?? 'English') }}" required maxlength="50">
        @error('language')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="course-level">Level</label>
        <select name="level" id="course-level" class="form-control @error('level') is-invalid @enderror" required>
            @foreach (['Beginner', 'Intermediate', 'Advanced'] as $level)
                <option value="{{ $level }}" @selected(old('level', $course->level ?? 'Beginner') === $level)>{{ $level }}</option>
            @endforeach
        </select>
        @error('level')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="course-price">Price (USD)</label>
        <input type="number" name="price" id="course-price" class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $course->price ?? '0') }}" required min="0" step="0.01">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="course-category">Category</label>
    <select name="category_id" id="course-category" class="form-control @error('category_id') is-invalid @enderror" required>
        <option value="">Select a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected((string) old('category_id', $course->category_id ?? '') === (string) $category->id)>
                {{ $category->title }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="course-thumbnail">Thumbnail image URL (optional)</label>
    <input type="url" name="thumbnail" id="course-thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
           value="{{ old('thumbnail', $course->thumbnail ?? '') }}" placeholder="https://…">
    @error('thumbnail')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Paste a direct link to an image, or leave blank to use the default.</small>
</div>

@php
    $visibilityOld = old('visibility');
    if ($visibilityOld === null) {
        $publishChecked = $isEdit && ! empty($course->visibility);
    } else {
        $publishChecked = filter_var($visibilityOld, FILTER_VALIDATE_BOOLEAN);
    }
@endphp
<div class="form-group form-check">
    <input type="hidden" name="visibility" value="0">
    <input type="checkbox" name="visibility" id="course-visibility" class="form-check-input" value="1"
           @checked($publishChecked)>
    <label class="form-check-label" for="course-visibility">Publish on the marketplace (visible in search and category pages)</label>
</div>
