class ApiController < ApplicationController
  # before_filter :oath_required

  respond_to :json, :xml
	def push
    @ft = GData::Client::FusionTables.new
    @ft.clientlogin(ENV['G_USER'], ENV['G_PASS'])
    @ft.set_api_key(ENV['FUSION_API_KEY'])
    data = [{"time_created"  => params[:time_created],
             "lat"           => params[:lat],
             "long"          => params[:long],
             "severity"      => params[:severity]}]
    # Find table somehow?
    # @success = table.insert data
	end

    #adding more api
end
