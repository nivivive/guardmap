class ApiController < ApplicationController
  # before_filter :oath_required

  respond_to :json, :xml
	def push
    @ft = GData::Client::FusionTables.new
    @ft.clientlogin(ENV['G_USER'], ENV['G_PASS'])
    @ft.set_api_key(ENV['FUSION_API_KEY'])
    if (params[:time_created].empty? ||
        params[:lat].empty? ||
        params[:long].empty? ||
        params[:severity].empty?)
      @success = false
    else
      data = [{"time_created"  => params[:time_created],
               "lat"           => params[:lat],
               "long"          => params[:long],
               "severity"      => params[:severity]}]
      # Find table somehow?
      tables = @ft.show_tables.select{ |table| table.id == '1gm-7p4_x7K4SfqRRhmJ8jokqbzi3t02YMY6n6q0'}
      @success = tables.first.insert data
    end
	end
end
