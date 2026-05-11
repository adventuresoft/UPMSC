<script src="https://cdn.tailwindcss.com"></script>
<div class="registration-wizard-wrapper mb-4">
    <div class="registration-stepper">
        @php
            $steps = [
                ['id' => 'personal', 'label' => 'ব্যক্তিগত', 'icon' => 'fa-user', 'route' => 'people.applications.registration.create'],
                ['id' => 'family', 'label' => 'পারিবারিক', 'icon' => 'fa-users', 'route' => 'people.applications.registration.family'],
                ['id' => 'address', 'label' => 'ঠিকানা', 'icon' => 'fa-map-marker-alt', 'route' => 'people.applications.registration.address'],
                ['id' => 'education', 'label' => 'শিক্ষা', 'icon' => 'fa-graduation-cap', 'route' => 'people.applications.registration.education'],
                ['id' => 'professional', 'label' => 'পেশা', 'icon' => 'fa-briefcase', 'route' => 'people.applications.registration.professional'],
                ['id' => 'financial', 'label' => 'আর্থিক', 'icon' => 'fa-wallet', 'route' => 'people.applications.registration.financial'],
                ['id' => 'property', 'label' => 'সম্পদ', 'icon' => 'fa-building', 'route' => 'people.applications.registration.property'],
                ['id' => 'disability', 'label' => 'প্রতিবন্ধিতা', 'icon' => 'fa-wheelchair', 'route' => 'people.applications.registration.disability'],
                ['id' => 'freedom', 'label' => 'মুক্তিযোদ্ধা', 'icon' => 'fa-medal', 'route' => 'people.applications.registration.freedom'],
                ['id' => 'july_fighter', 'label' => 'জুলাই ২৪ যোদ্ধা', 'icon' => 'fa-fist-raised', 'route' => 'people.applications.registration.july_fighter'],
            ];
            
            $activeIndex = 0;
            $userId = isset($user->user_id) ? $user->user_id : (isset($user->id) ? $user->id : null);
            foreach($steps as $index => $step) {
                if($active_tab == $step['id']) $activeIndex = $index;
            }
        @endphp

        <div class="stepper-horizontal">
            @foreach($steps as $index => $step)
                <div class="step-item {{ $active_tab == $step['id'] ? 'active' : ($index < $activeIndex ? 'completed' : '') }}">
                    <a href="{{ $userId ? route($step['route'], $userId) : '#' }}" class="step-link">
                        <div class="step-icon-wrap">
                            <div class="step-icon">
                                @if($index < $activeIndex)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas {{ $step['icon'] }}"></i>
                                @endif
                            </div>
                        </div>
                        <span class="step-label">{{ $step['label'] }}</span>
                    </a>
                    @if(!$loop->last)
                        <div class="step-line"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .registration-wizard-wrapper {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 10px;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .registration-wizard-wrapper::-webkit-scrollbar {
        display: none;
    }
    
    .stepper-horizontal {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        min-width: 900px;
        padding: 15px 10px;
    }
    
    .step-item {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .step-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        color: inherit;
        z-index: 2;
        transition: all 0.3s ease;
    }
    
    .step-icon-wrap {
        width: 36px;
        height: 36px;
        margin-bottom: 8px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .step-icon {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #e2e8f0;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    
    .step-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        white-space: nowrap;
        transition: all 0.3s ease;
    }
    
    .step-line {
        position: absolute;
        top: 18px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 1;
    }
    
    /* Active State */
    .step-item.active .step-icon {
        background: #046307;
        border-color: #046307;
        color: #fff;
        transform: scale(1.15);
        box-shadow: 0 4px 10px rgba(4, 99, 7, 0.2);
    }
    
    .step-item.active .step-label {
        color: #046307;
        font-weight: 800;
    }
    
    /* Completed State */
    .step-item.completed .step-icon {
        background: #e6f4ea;
        border-color: #34a853;
        color: #34a853;
    }
    
    .step-item.completed .step-label {
        color: #34a853;
    }
    
    .step-item.completed .step-line {
        background: #34a853;
    }
    
    .step-link:hover .step-icon {
        border-color: #046307;
        color: #046307;
    }
</style>
