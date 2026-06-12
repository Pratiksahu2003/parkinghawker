<x-admin-layout>
    <x-slot name="title">Edit Post</x-slot>
    <x-slot name="breadcrumb">
        <a href="{{ route('admin.posts.index') }}" class="hover:text-white transition-colors">Blog Posts</a>
        <span class="mx-1.5">/</span>
        <span class="text-white">Edit</span>
    </x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Blog Post</h1>
        <p class="text-sm text-neutral-500 mt-1">Make adjustments, rewrite sections, or change publication options.</p>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        @method('PUT')

        <!-- Main Content (2 cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Title & Content -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <div>
                    <label for="title" class="block text-sm font-semibold text-neutral-300 mb-1.5">Post Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required placeholder="e.g. 10 Hacks for Stress-Free City Parking" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                </div>

                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-neutral-300 mb-1.5">Excerpt / Summary</label>
                    <textarea name="excerpt" id="excerpt" rows="3" placeholder="A short, catchy description of the post shown in listing pages..." class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold text-neutral-300 mb-1.5">Content Body <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" class="hidden">{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            <!-- YouTube & Media -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <h2 class="text-lg font-bold text-white tracking-tight mb-2">Media & Video Integrations</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="featured_image" class="block text-sm font-semibold text-neutral-300 mb-1.5">Featured Image URL</label>
                        <input type="url" name="featured_image" id="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="https://unsplash.com/photos/..." class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                    </div>

                    <div>
                        <label for="youtube_url" class="block text-sm font-semibold text-neutral-300 mb-1.5">YouTube Video URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $post->youtube_url) }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                    </div>
                </div>
                <p class="text-xs text-neutral-500">Provide a YouTube link to automatically embed a premium responsive video player at the top of the post view.</p>
            </div>

            <!-- SEO Overrides -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <h2 class="text-lg font-bold text-white tracking-tight mb-2">SEO Optimization</h2>

                <div>
                    <label for="meta_title" class="block text-sm font-semibold text-neutral-300 mb-1.5">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}" placeholder="Default: Same as post title" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-semibold text-neutral-300 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" placeholder="Default: Same as post excerpt" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Sidebar / Settings (1 col) -->
        <div class="space-y-6">
            <!-- Publishing & Status -->
            <div class="glass-card rounded-2xl p-6 space-y-5">
                <h2 class="text-lg font-bold text-white tracking-tight">Publishing Settings</h2>

                <div>
                    <label for="status" class="block text-sm font-semibold text-neutral-300 mb-1.5">Post Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published (Live)</option>
                        <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-semibold text-neutral-300 mb-1.5">Scheduled Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                    <span class="text-[10px] text-neutral-500 mt-1 block">Leave empty to publish immediately.</span>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }} class="h-4.5 w-4.5 rounded bg-white/5 border-white/10 text-brand-cyan focus:ring-brand-cyan focus:ring-opacity-25 focus:ring-2">
                    <label for="is_featured" class="text-sm font-semibold text-neutral-300 cursor-pointer">Pin as Featured Post</label>
                </div>
            </div>

            <!-- Taxonomy & Author -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <h2 class="text-lg font-bold text-white tracking-tight">Organization</h2>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-neutral-300 mb-1.5">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required class="w-full px-4 py-2.5 rounded-xl bg-dark-secondary border border-white/10 text-neutral-300 text-sm focus:outline-none focus:border-brand-cyan">
                        <option value="" disabled>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tags" class="block text-sm font-semibold text-neutral-300 mb-1.5">Tags (Comma Separated)</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', is_array($post->tags) ? implode(', ', $post->tags) : '') }}" placeholder="e.g. EV, Smart Tech, Parking" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                </div>
            </div>

            <!-- Author details -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <h2 class="text-lg font-bold text-white tracking-tight">Author Info</h2>

                <div>
                    <label for="author_name" class="block text-sm font-semibold text-neutral-300 mb-1.5">Author Name <span class="text-red-500">*</span></label>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $post->author_name) }}" required placeholder="e.g. Sarah Sterling" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                </div>

                <div>
                    <label for="author_role" class="block text-sm font-semibold text-neutral-300 mb-1.5">Author Role / Title</label>
                    <input type="text" name="author_role" id="author_role" value="{{ old('author_role', $post->author_role) }}" placeholder="e.g. Smart Cities Consultant" class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-brand-cyan placeholder:text-neutral-600">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center gap-3">
                <button type="submit" class="flex-1 px-5 py-3 rounded-xl bg-brand-cyan text-dark-primary font-bold text-sm hover:bg-brand-cyan/90 transition-colors shadow-lg shadow-brand-cyan/20">
                    Update Post
                </button>
                <a href="{{ route('admin.posts.index') }}" class="px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-white/10 transition-colors">
                    Cancel
                </a>
            </div>
        </div>
    </form>

    <!-- TinyMCE CDN Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#content',
                skin: 'oxide-dark',
                content_css: 'dark',
                height: 450,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image media | code fullscreen',
                content_style: 'body { font-family: "Instrument Sans", sans-serif; font-size: 14px; background-color: #0b0f19; color: #f8fafc; }',
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
        });
    </script>
</x-admin-layout>
