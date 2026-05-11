@php
    $userId = isset($user->id) ? $user->id : (isset($user_id) ? $user_id : null);
    $steps = [
        ['id' => 'personal',     'name' => 'Personal',      'route' => $userId ? route('councilor.edit', $userId) : '#',        'icon' => 'fa-user'],
        ['id' => 'family',       'name' => 'Family',        'route' => $userId ? route('councilor.family', $userId) : '#',      'icon' => 'fa-users'],
        ['id' => 'address',      'name' => 'Address',       'route' => $userId ? route('councilor.address', $userId) : '#',     'icon' => 'fa-map-marker-alt'],
        ['id' => 'education',    'name' => 'Education',     'route' => $userId ? route('councilor.education', $userId) : '#',   'icon' => 'fa-graduation-cap'],
        ['id' => 'professional', 'name' => 'Profession',    'route' => $userId ? route('councilor.professional', $userId) : '#','icon' => 'fa-briefcase'],
        ['id' => 'financial',    'name' => 'Financial',     'route' => $userId ? route('councilor.financial', $userId) : '#',   'icon' => 'fa-wallet'],
        ['id' => 'property',     'name' => 'Property',      'route' => $userId ? route('councilor.property', $userId) : '#',    'icon' => 'fa-building'],
        ['id' => 'disability',   'name' => 'Disability',    'route' => $userId ? route('councilor.disability', $userId) : '#',  'icon' => 'fa-wheelchair'],
        ['id' => 'freedom',      'name' => 'Freedom',       'route' => $userId ? route('councilor.freedom', $userId) : '#',     'icon' => 'fa-medal'],
        ['id' => 'july_fighter', 'name' => 'July 24 Fighter', 'route' => $userId ? route('councilor.july_fighter', $userId) : '#', 'icon' => 'fa-fist-raised'],
        ['id' => 'area',         'name' => 'Area',          'route' => $userId ? route('councilor.area', $userId) : '#',        'icon' => 'fa-map'],
    ];
    $current_found = false;
@endphp

<div class="registration-stepper-wrapper mb-4">
    <div class="registration-stepper-container">
        <div class="stepper-scroll-container hide-scrollbar">
            <div class="stepper-inner">
                @foreach($steps as $index => $step)
                    @php
                        $isActive    = $active_tab == $step['id'];
                        if ($isActive) $current_found = true;
                        $isCompleted = !$isActive && $current_found == false && $userId;
                    @endphp

                    <div class="step-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                        <a href="{{ $step['route'] }}" class="step-link" onclick="{{ !$userId && !$isActive ? "event.preventDefault(); toastr.warning('Please save personal info first!');" : '' }}">
                            <div class="step-circle">
                                @if($isCompleted)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas {{ $step['icon'] }}"></i>
                                @endif
                            </div>
                            <span class="step-label">{{ $step['name'] }}</span>
                        </a>
                    </div>

                    @if($index < count($steps) - 1)
                        <div class="step-line {{ $isCompleted ? 'completed' : '' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .registration-stepper-wrapper { width: 100%; padding: 5px 0; }
    .registration-stepper-container { background: #ffffff; border-radius: 12px; padding: 10px 15px; border: 1px solid #e5e7eb; }
    .stepper-scroll-container { overflow-x: auto; overflow-y: hidden; -webkit-overflow-scrolling: touch; }
    .stepper-inner { display: flex; align-items: center; justify-content: space-between; min-width: max-content; padding: 5px 10px; }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    
    .step-item { flex: 0 0 auto; position: relative; z-index: 2; }
    .step-link { color: #6b7280; text-align: center; display: flex; flex-direction: column; align-items: center; text-decoration: none !important; transition: all 0.2s; }
    .step-circle { width: 34px; height: 34px; border-radius: 10px; background: #f3f4f6; border: 2px solid #e5e7eb; color: #9ca3af; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; transition: all 0.2s; }
    .step-label { font-size: 0.65rem; font-weight: 700; margin-top: 6px; text-transform: uppercase; letter-spacing: 0.02em; color: #6b7280; }
    
    .step-item.active .step-circle { background: #4f46e5; border-color: #4f46e5; color: #ffffff; box-shadow: 0 4px 10px -2px rgba(79, 70, 229, 0.4); }
    .step-item.active .step-label { color: #4f46e5; }
    .step-item.completed .step-circle { background: #ecfdf5; border-color: #10b981; color: #10b981; }
    .step-line { flex: 0 0 auto; height: 2px; background: #e5e7eb; width: 30px; margin: 0 5px; margin-top: -20px; }
    .step-line.completed { background: #10b981; }
</style>
