<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                <img src="<?php echo e(asset('uploads/logo/' . setting('site_logo')) . '?' . time()); ?>" class="navbar-brand-img"
                    alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(in_array($current_page, ['dashboard']) ? 'active' : ''); ?>"
                            href="<?php echo e(route('dashboard')); ?>">
                            <i class="ni ni-tv-2"></i> <span class="nav-link-text"><?php echo e(__('labels.dashboard')); ?></span>
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['mortgages.*', 'mortgages.index', 'mortgages.create', 'mortgages.edit',
                        'mortgages.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['mortgage', 'mortgage-submission']) ? 'active' : ''); ?>"
                                href="#nav-mortgages" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['mortgage', 'mortgage-submission']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-mortgages">
                                <i class="fa fa-home"></i>
                                <span class="nav-link-text">Debt</span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['mortgage', 'mortgage-submission']) ? 'show' : ''); ?>"
                                id="nav-mortgages">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['mortgages.create'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('mortgages.create')); ?>"
                                                class="nav-link <?php echo e($current_page == 'mortgage-submission' ? 'active' : ''); ?>">Submission
                                                Form</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['mortgages.index'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('mortgages.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'mortgage' ? 'active' : ''); ?>">Sales-Sheet</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['mortgages.client'])): ?>
                                        
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['solars.index', 'solars.create', 'solars.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['solar', 'solar-submission']) ? 'active' : ''); ?>"
                                href="#nav-solars" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['solar', 'solar-submission']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-solars">
                                <i class="fa fa-sun"></i>
                                <span class="nav-link-text">Solar</span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['solars', 'solar-submission']) ? 'show' : ''); ?>"
                                id="nav-solars">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['solars.create', 'solars.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('solars.create')); ?>"
                                                class="nav-link <?php echo e($current_page == 'solar-submission' ? 'active' : ''); ?>">Submission
                                                Form</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['solars.index'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('solars.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'solar' ? 'active' : ''); ?>">Sales-Sheet</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['solars.client'])): ?>
                                        
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['home-warranties.index', 'home-warranties.create', 'home-warranties.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['home-warranties', 'home-warranties-submission']) ? 'active' : ''); ?>"
                                href="#nav-homews" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['home-warranties', 'home-warranties-submission']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-homews">
                                <i class="fa fa-bed"></i>
                                <span class="nav-link-text">Home Warranty</span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['home-warranties', 'home-warranties-submission']) ? 'show' : ''); ?>"
                                id="nav-homews">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['home-warranties.create', 'home-warranties.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('home-warranties.create')); ?>"
                                                class="nav-link <?php echo e($current_page == 'home-warranties-submission' ? 'active' : ''); ?>">Submission
                                                Form</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['home-warranties.index'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('home-warranties.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'home-warranties' ? 'active' : ''); ?>">Sales-Sheet</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['campaigns.index', 'campaigns.create', 'campaigns.delete'])): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['campaigns']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('campaigns.index')); ?>">
                                <i class="fa fa-archive"></i> <span class="nav-link-text">Campaigns</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['clients.index', 'clients.create', 'clients.delete'])): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['clients']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('clients.index')); ?>">
                                <i class="fa fa-box"></i> <span class="nav-link-text">Clients</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['projects.index', 'projects.create', 'projects.delete'])): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['projects']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('projects.index')); ?>">
                                <i class="fa fa-list"></i> <span class="nav-link-text">Projects</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Discount school supply starts -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['dss.*', 'dss.index', 'dss.create', 'dss.edit', 'dss.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['dss', 'dss-submission']) ? 'active' : ''); ?>"
                                href="#nav-dss" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['dss', 'dss-submission']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-dss">
                                <i class="fa fa-graduation-cap"></i>
                                <span class="nav-link-text">DSS</span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['dss', 'dss-submission']) ? 'show' : ''); ?>"
                                id="nav-dss">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['dss.create'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('dss.create')); ?>"
                                                class="nav-link <?php echo e($current_page == 'dss-submission' ? 'active' : ''); ?>">Submission-Form</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['dss.index'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('dss.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'dss' ? 'active' : ''); ?>">Sale-Sheet</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('dss.line-chart')); ?>"
                                                class="nav-link <?php echo e($current_page == 'dss' ? 'active' : ''); ?>">Graphs</a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                    <!-- Discount school supply ends -->
					 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['cmu-sales.import-form'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['cmu-sales.import-form']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('cmu-sales.import-form')); ?>">
                                <i class="fa fa-phone"></i> <span
                                    class="nav-link-text">CMU Sales</span>
                            </a>
                        </li>
                    <?php endif; ?>
                      <!-- Call analytics Sales Starts -->
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['call-analytic-sales.import-form'])): ?>
                      <li class="nav-item">
                          

                          <a class="nav-link <?php echo e(in_array($current_page, ['call-analytic-sales.import-form']) ? 'active' : ''); ?>"
                          href="#nav-cax" data-toggle="collapse" role="button"
                          aria-expanded="<?php echo e(in_array($current_page, ['call-analytic-sales.import-form']) ? 'true' : 'false'); ?>"
                          aria-controls="nav-cax">
                          <i class="fa fa-graduation-cap"></i>
                          <span class="nav-link-text">Call Analytics</span>
                      </a>
                      <div class="collapse <?php echo e(in_array($current_page, ['call-analytic-sales.import-form']) ? 'show' : ''); ?>"
                      id="nav-cax">
                      <ul class="nav nav-sm flex-column">
                              <li class="nav-item">
                                  <a href="<?php echo e(route('call-analytic-sales.import-form')); ?>"
                                      class="nav-link <?php echo e($current_page == 'call-analytic-sales.import-form' ? 'active' : ''); ?>">Upload and View Data</a>
                              </li>
                      </ul>
                      <ul class="nav nav-sm flex-column">
                          <li class="nav-item">
                              <a href="<?php echo e(route('call-analytic-sales.stats')); ?>"
                                  class="nav-link <?php echo e($current_page == 'call-analytic-sales.stats' ? 'active' : ''); ?>">CAX-Stats</a>
                          </li>
                  </ul>
                  </div>
                      </li>
                  <?php endif; ?>

                  <!--Call analytics Sales ends -->
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['eddy-sales.import-form'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['eddy-sales.import-form']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('eddy-sales.import-form')); ?>">
                                <i class="ni ni-chart-bar-32"></i> <span class="nav-link-text">Eddy Sales</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['eddyusers']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('eddyusers')); ?>">
                                <i class="fa fa-users"></i> <span class="nav-link-text">Eddy Users</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['kb.*', 'kb.index', 'kb.create', 'kb.edit', 'kb.delete', 'kb_category.*',
                        'kb_category.index', 'kb_category.create', 'kb_category.edit', 'kb_category.delete'])): ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['kb', 'kb_category', 'kb_sub_categories']) ? 'active' : ''); ?>"
                                href="#nav-knowledge_bases" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['kb', 'kb_category', 'kb_sub_categories']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-knowledge_bases">
                                <i class="ni ni-single-copy-04"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.knowledge_bases')); ?></span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['kb', 'kb_category', 'kb_sub_categories']) ? 'show' : ''); ?>"
                                id="nav-knowledge_bases">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['kb.*', 'kb.index', 'kb.create', 'kb.edit', 'kb.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('knowledge_bases.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'kb' ? 'active' : ''); ?>"><?php echo e(__('labels.knowledge_bases')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['kb_category.*', 'kb_category.index', 'kb_category.create', 'kb_category.edit',
                                        'kb_category.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('kb_categories.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'kb_category' ? 'active' : ''); ?>"><?php echo e(__('labels.category')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('kb_sub_categories.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'kb_sub_categories' ? 'active' : ''); ?>"><?php echo e(__('labels.sub_category')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>

                    <?php endif; ?>


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['designation.*', 'designation.index', 'designation.create', 'designation.edit',
                        'designation.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['designations']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('designations.index')); ?>">
                                <i class="ni ni-books"></i> <span class="nav-link-text">Designation</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['priority.*', 'priority.index', 'priority.create', 'priority.edit', 'priority.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['priorities']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('priorities.index')); ?>">
                                <i class="ni ni-bullet-list-67"></i> <span
                                    class="nav-link-text"><?php echo e(__('labels.priority')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['faq.*', 'faq.index', 'faq.create', 'faq.edit', 'faq.delete', 'faq_category.*',
                        'faq_category.index', 'faq_category.create', 'faq_category.edit', 'faq_category.delete'])): ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['faq', 'faq_category']) ? 'active' : ''); ?>"
                                href="#nav-faqs" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['faq', 'faq_category']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-faqs">
                                <i class="ni ni-folder-17"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.faq')); ?></span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['faq', 'faq_category']) ? 'show' : ''); ?>"
                                id="nav-faqs">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['faq.*', 'faq.index', 'faq.create', 'faq.edit', 'faq.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('faqs.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'faq' ? 'active' : ''); ?>"><?php echo e(__('labels.faqs')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['faq_category.*', 'faq_category.index', 'faq_category.create',
                                        'faq_category.edit', 'faq_category.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('faq-category.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'faq_category' ? 'active' : ''); ?>"><?php echo e(__('labels.category')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>

                    <?php endif; ?>
                   

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['department.*', 'department.index', 'department.create', 'department.edit',
                        'department.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['departments']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('departments.index')); ?>">
                                <i class="ni ni-books"></i> <span
                                    class="nav-link-text"><?php echo e(__('labels.departments')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['priority.*', 'priority.index', 'priority.create', 'priority.edit', 'priority.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['priorities']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('priorities.index')); ?>">
                                <i class="ni ni-bullet-list-67"></i> <span
                                    class="nav-link-text"><?php echo e(__('labels.priority')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ticket.*', 'ticket.index', 'ticket.create', 'ticket.edit', 'ticket.delete',
                        'ticket_canned_messages.*', 'ticket_canned_messages.index', 'ticket_canned_messages.create',
                        'ticket_canned_messages.edit', 'ticket_canned_messages.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['tickets', 'canned_messages']) ? 'active' : ''); ?>"
                                href="#nav-tickets" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['tickets', 'canned_messages']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-tickets">
                                <i class="fa fa-life-ring"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.tickets')); ?></span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['tickets', 'canned_messages']) ? 'show' : ''); ?>"
                                id="nav-tickets">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ticket_canned_messages.*', 'ticket_canned_messages.index',
                                        'ticket_canned_messages.create', 'ticket_canned_messages.edit',
                                        'ticket_canned_messages.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('canned_messages.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'canned_messages' ? 'active' : ''); ?>"><?php echo e(__('labels.canned_messages')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ticket.*', 'ticket.index', 'ticket.create', 'ticket.edit', 'ticket.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('tickets.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'tickets' ? 'active' : ''); ?>"><?php echo e(__('labels.all_tickets')); ?></a>
                                        </li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['ticket.*'])): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('tickets.index', ['status' => 'unassigned'])); ?>"
                                                    class="nav-link"><?php echo e(__('labels.unassigned_tickets')); ?>

                                                    <?php if(($countTicket = \App\Models\Ticket::where('user_id', '<=', 0)->orWhere('user_id', '=', null)->count()) > 0): ?>
                                                        &nbsp;&nbsp; <span
                                                            class="badge badge-danger badge-circle"><?php echo e($countTicket); ?></span>
                                                    <?php endif; ?>
                                                </a>

                                            </li>
                                        <?php endif; ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('tickets.index', ['status' => 'open'])); ?>"
                                                class="nav-link"><?php echo e(__('labels.open_tickets')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('tickets.index', ['status' => 'closed'])); ?>"
                                                class="nav-link"><?php echo e(__('labels.closed_tickets')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['customer.*', 'customer.index', 'customer.create', 'customer.edit', 'customer.delete'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['customers']) ? 'active' : ''); ?>"
                                href="<?php echo e(route('customers.index')); ?>">
                                <i class="fa fa-users"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.customers')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['users.*', 'users.index', 'users.create', 'users.edit', 'users.delete', 'role.*',
                        'role.index', 'role.create', 'role.edit', 'role.delete'])): ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['users', 'roles']) ? 'active' : ''); ?>"
                                href="#nav-users" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['users', 'roles']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-users">
                                <i class="fa fa-users"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.users')); ?></span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['roles', 'users']) ? 'show' : ''); ?>"
                                id="nav-users">
                                <ul class="nav nav-sm flex-column">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role.*', 'role.index', 'role.create', 'role.edit', 'role.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('roles.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'roles' ? 'active' : ''); ?>"><?php echo e(__('labels.roles')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['users.*', 'users.index', 'users.create', 'users.edit', 'users.delete'])): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('users.index')); ?>"
                                                class="nav-link <?php echo e($current_page == 'users' ? 'active' : ''); ?>"><?php echo e(__('labels.users')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['settings.*'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(in_array($current_page, ['general_settings', 'frontend_settings', 'language_settings', 'api_settings', 'ticket_settings']) ? 'active' : ''); ?>"
                                href="#nav-settings" data-toggle="collapse" role="button"
                                aria-expanded="<?php echo e(in_array($current_page, ['faq']) ? 'true' : 'false'); ?>"
                                aria-controls="nav-settings">
                                <i class="fa fa-cog"></i>
                                <span class="nav-link-text"><?php echo e(__('labels.settings')); ?></span>
                            </a>
                            <div class="collapse <?php echo e(in_array($current_page, ['general_settings', 'frontend_settings', 'language_settings', 'api_settings', 'ticket_settings']) ? 'show' : ''); ?>"
                                id="nav-settings">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.general')); ?>"
                                            class="nav-link <?php echo e($current_page == 'general_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.general_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.language')); ?>"
                                            class="nav-link <?php echo e($current_page == 'language_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.language_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.api')); ?>"
                                            class="nav-link <?php echo e($current_page == 'api_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.api_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.frontend')); ?>"
                                            class="nav-link <?php echo e($current_page == 'frontend_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.frontend_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.ticket')); ?>"
                                            class="nav-link <?php echo e($current_page == 'ticket_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.ticket_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.email')); ?>"
                                            class="nav-link <?php echo e($current_page == 'email_settings' ? 'active' : ''); ?>"><?php echo e(__('labels.email_settings')); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('settings.email_templates')); ?>"
                                            class="nav-link <?php echo e($current_page == 'email_templates' ? 'active' : ''); ?>"><?php echo e(__('labels.email_templates')); ?></a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/vhosts/crm.touchstone-communications.com/httpdocs/resources/views/admin/layouts/navbars/sidebar.blade.php ENDPATH**/ ?>