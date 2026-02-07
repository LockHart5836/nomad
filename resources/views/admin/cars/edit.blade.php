<x-admin-layout title="Edit Car - Admin Panel" pageTitle="Edit Vehicle">
    <div class="container-fluid">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.cars.index') }}" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i> Back to Vehicles
            </a>
        </div>
        <br>

        <!-- Main Card -->
        <div class="card">
            <div class="card-header">
                <div class="header-content">
                    <h5 class="header-title">
                        <i class="fas fa-edit me-2"></i>  Edit Vehicle Information
                    </h5>
                    <p class="header-subtitle">Update vehicle details and availability status</p>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Car Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $car->name) }}" 
                                       placeholder="e.g., Toyota Vios 2024" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>  <br>  <br>  <br>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="sedan" {{ old('category', $car->category) == 'sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="suv" {{ old('category', $car->category) == 'suv' ? 'selected' : '' }}>SUV</option>
                                    <option value="truck" {{ old('category', $car->category) == 'truck' ? 'selected' : '' }}>Truck</option>
                                    <option value="luxury" {{ old('category', $car->category) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                    <option value="sports" {{ old('category', $car->category) == 'sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="van" {{ old('category', $car->category) == 'van' ? 'selected' : '' }}>Van</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price per Day (₱) *</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" step="0.01" min="0" 
                                       value="{{ old('price', $car->price) }}" placeholder="1500.00" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Specifications Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="fas fa-cogs me-2"></i>Specifications
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="seats" class="form-label">Number of Seats *</label>
                                <input type="number" class="form-control @error('seats') is-invalid @enderror" 
                                       id="seats" name="seats" min="1" 
                                       value="{{ old('seats', $car->seats) }}" placeholder="5" required>
                                @error('seats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="transmission" class="form-label">Transmission *</label>
                                <select class="form-control @error('transmission') is-invalid @enderror" id="transmission" name="transmission" required>
                                    <option value="">Select Transmission</option>
                                    <option value="Automatic" {{ old('transmission', $car->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="Manual" {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="CVT" {{ old('transmission', $car->transmission) == 'CVT' ? 'selected' : '' }}>CVT</option>
                                </select>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="features" class="form-label">Features</label>
                                <input type="text" class="form-control @error('features') is-invalid @enderror" 
                                       id="features" name="features" value="{{ old('features', $car->features) }}" 
                                       placeholder="e.g., AC, GPS, Bluetooth">
                                <small class="text-muted">Separate features with commas</small>
                                @error('features')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description & Media Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="fas fa-image me-2"></i>Description & Media
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" 
                                          placeholder="Enter vehicle description">{{ old('description', $car->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">Car Image</label>
                                @if($car->image)
                                    <div class="current-image-preview mb-3">
                                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                                        <p class="text-muted mt-2"><small>Current image shown above. Upload a new image to replace it.</small></p>
                                    </div>
                                    <br>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <small class="text-muted">Recommended size: 800x600px. Max 5MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Availability Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="fas fa-check-circle me-2"></i>Availability
                        </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="available" name="available" value="1" 
                                           {{ old('available', $car->available) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="available">
                                        Available for Rent
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>ㅤUpdate Vehicle
                        </button>
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>ㅤCancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <style>
        .container-fluid {
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 10px 20px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
        }

        .back-btn:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: translateX(-5px);
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px 15px 0 0;
        }

        .header-content {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .header-title {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .card-body {
            padding: 30px;
        }

        /* Improved form sections with better spacing and alignment */
        .form-section {
            margin-bottom: 32px;
            padding-bottom: 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 24px;
            padding-bottom: 0;
        }

        .section-title {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: block;
        }

        /* Added consistent height and alignment for form controls */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            min-height: 44px;
            width: 100%;
            display: block;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #667eea;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        select.form-control option {
            background: #1a1f2e;
            color: white;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 0.85rem;
            margin-top: 6px;
            display: block;
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 6px;
            display: block;
        }

        .is-invalid {
            border-color: #ff6b6b !important;
        }

        .current-image-preview {
            padding: 16px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
        }

        .current-image-preview img {
            max-width: 300px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: block;
        }

        /* Improved checkbox styling with better alignment */
        .form-check {
            display: flex;
            align-items: center;
            padding: 12px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            margin: 0;
            flex-shrink: 0;
            min-width: 20px;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            margin-left: 12px;
            cursor: pointer;
            margin-bottom: 0;
            font-weight: 500;
        }

        /* Improved action buttons layout with better spacing */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            font-size: 0.95rem;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.95rem;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        /* Improved row and column alignment for balanced layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6, .col-md-12 {
            padding-right: 15px;
            padding-left: 15px;
            flex: 0 0 auto;
        }

        .col-md-12 {
            width: 100%;
        }

        @media (min-width: 768px) {
            .col-md-6 {
                width: 50%;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 20px;
            }

            .card-header {
                padding: 20px;
            }

            .card-body {
                padding: 20px;
            }

            .header-title {
                font-size: 1.25rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
            }

            .col-md-6 {
                width: 100%;
            }
        }
    </style>
</x-admin-layout>
